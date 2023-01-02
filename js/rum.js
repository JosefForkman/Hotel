
fetch(`/API/room/?id=${rum}`)
.then(respond => respond.json())
.then(rum => {
    console.log(rum);
        /* Make all article element */
        const introduktion = document.querySelector('.introduktion');

        const boka = document.querySelector('.boka');
        const h2 = boka.querySelector('h2');

        const img = introduktion.querySelector('img');
        const span = introduktion.querySelector('h2 span');
        const p = introduktion.querySelector('p');

        /* add data to element */
        img.src = `img/${rum.url}`;
        span.textContent = rum.name;
        p.textContent = rum.description;

        h2.textContent = `${rum.price}kr / natt`;
    })
