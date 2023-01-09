const [ rum, pris, antal, rabatt, summa ] = document.querySelectorAll('table tr td');
const form = document.querySelector('form');
const inputs = form.querySelectorAll('input');
const pre = document.querySelector('pre');


const id = JSON.parse(localStorage.getItem('BookDate'));

/* fetch data to summary */
const roomSummary = async (id) => {
    let summary = await fetch(`API/room?id=${id}`);
    summary = await summary.json()
    return summary;
}

/* Ger antal dagar */
const start = new Date(id.start);
const end = new Date(id.end);
const antalNätter = end.getDate() == start.getDate()? 1 : end.getDate() - start.getDate();

/* Fuller i sammanfattningen för köpet */
roomSummary(id.rum).then(res => {
    rum.textContent = res.name
    pris.textContent = `${res.price}$ / natt`;
    antal.textContent = `${antalNätter}st`;
    summa.textContent = `${new Intl.NumberFormat().format(res.price * antalNätter)}$`
})


/* Form */
form.addEventListener('submit', async e => {
    e.preventDefault();

    try {
        const room = await roomSummary(id.rum);

        const formData = new FormData(e.target);
        formData.append('arrival_date', id.start);
        formData.append('departure_date', id.end);
        formData.delete('discount')
        formData.append('totalCost', room.price * antalNätter);

        let book = await fetch(`API/calender/book?id=${id.rum}`, {
            method: 'POST',
            body: formData
        })

        book = await book.json();

        fillBekraftelse(book);

        pre.classList.add('active')

    } catch (error) {
        console.error(error)
    }
})

function fillBekraftelse(data) {
    const island = document.querySelector('#island');
    const hotel = document.querySelector('#hotel');
    const arrivalDate = document.querySelector('#arrival_date');
    const departureDate = document.querySelector('#departure_date');
    const totalCost = document.querySelector('#total_cost');
    const stars = document.querySelector('#stars');
    const features = document.querySelector('#features');
    const info = document.querySelector('#info');

    island.textContent = data.island;
    hotel.textContent = data.hotel;
    arrivalDate.textContent = data.arrival_date;
    departureDate.textContent = data.departure_date;
    totalCost.textContent = data.total_cost;
    stars.textContent = data.stars;
    features.textContent = JSON.stringify(data.features);
    info.textContent = JSON.stringify(data.addtional_info);
}
