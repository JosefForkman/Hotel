
fetch(`API/room?id=${rum}`)
.then(respond => respond.json())
.then(rum => {
        const urlSearchParams = new URLSearchParams(window.location.search);
        const rumid = Object.fromEntries(urlSearchParams.entries());

        /* Date */
        const start = new Date();
        start.setHours(0)
        start.setMinutes(0)
        start.setSeconds(0)
        start.setMilliseconds(0)

        const end = new Date();
        end.setHours(0)
        end.setMinutes(0)
        end.setSeconds(0)
        end.setMilliseconds(0)


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

        h2.textContent = `${rum.price}$ / natt`;

        // Add to localStorage
        localStorage.setItem("BookDate",JSON.stringify({
            start: start.toISOString(),
            end: end.toISOString(),
            rum: parseInt(rumid.rum)
        }));
    })
