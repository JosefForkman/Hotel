const [ rum, pris, antal, rabatt, summa ] = document.querySelectorAll('table tr td');
const form = document.querySelector('form');
const inputs = form.querySelectorAll('input');

const error = []

const id = JSON.parse(localStorage.getItem('BookDate'));

/* fetch data to summary */
fetch(`/API/room/?id=${id.rum}`)
    .then(data => data.json())
    .then(respond => {
        console.log(respond);
        const start = new Date(id.start);
        const end = new Date(id.end);
        const antalNätter = end.getDate() - start.getDate();

        pris.textContent = `${respond.price}kr / natt`;
        antal.textContent = `${antalNätter}st`;
        summa.textContent = `${new Intl.NumberFormat().format(respond.price * antalNätter)}kr`
    })


/* Form */

form.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(e.target);

    fetch('/api/room', {
        method: 'post',
        body: formData
    })
    .then( data => data.json() )
    .then( res => {
        console.log(res);
    })
    .catch( error => console.log(error))

    console.log(formData);
})
