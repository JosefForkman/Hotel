const [ rum, pris, förmåner, antal, rabatt, summa ] = document.querySelectorAll('table tr td');
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

/* Discount event listener */
/* check if discount is valid */
inputs[2].addEventListener('change', async e => {
    try {
	    let discount = await fetch(`http://localhost:8080/API/discount?name=${inputs[2].value}`);
        if (discount.ok) {
            console.log(true);
            discount = await discount.json();
            inputs[2].setCustomValidity("");
            console.log(discount.amount * 100);
            console.log(rabatt.textContent);
            rabatt.textContent = `${discount.amount * 100}%`;
            summa.textContent = `${summa.textContent.split('$')[0] * parseFloat(discount.amount)}$`

        } else {
            console.log(false);
            inputs[2].setCustomValidity(`Hittade inte rabatt med "${inputs[2].value}"`);
        }
    } catch (error) {
        if (e.target.value != "") {
            e.target.setCustomValidity(`Hittade inte rabatt med "${error.error}"`);
        }
    }
})

/* Fuller i sammanfattningen för köpet */
roomSummary(id.rum).then(async res => {
    let discount = await fetch(`http://localhost:8080/API/discount?name=${inputs[2].value}`);
    discount = await discount.json();

    const förmånersPris = res.features.reduce( (accumulator, currentValue) => {
        return accumulator += currentValue.price
    }, 0)

    rum.textContent = res.name
    pris.textContent = `${res.price}$ / natt`;
    antal.textContent = `${antalNätter}st`;

    summa.textContent = `${new Intl.NumberFormat().format(res.price * antalNätter + förmånersPris)}$`
    förmåner.textContent = förmånersPris + "$"
})


/* Form */
form.addEventListener('submit', async e => {
    e.preventDefault();

    try {
        const room = await roomSummary(id.rum);

        let discount = await fetch(`http://localhost:8080/API/discount?name=${inputs[2].value}`);
	    discount = await discount.json();

        console.log(parseFloat(discount.amount));

        let featureTotalPrice = room.features.reduce( (accumulator, currentValue) => {
            return accumulator += currentValue.price
        }, 0)


        const formData = new FormData(e.target);
        formData.append('arrival_date', id.start);
        formData.append('departure_date', id.end);
        formData.delete('discount')
        formData.append('totalCost', (room.price * antalNätter + featureTotalPrice) * parseFloat(discount.amount));

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
    features.textContent = JSON.stringify(data.features, null, 2);
    info.textContent = JSON.stringify(data.addtional_info, null, 2);
}
