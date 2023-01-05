const boende = document.querySelector('.boende');

fetch("/API/room")
    .then(respond => respond.json())
    .then(data => {
        console.log(data);
        data.forEach(rum => {
            console.log(rum);
            /* Make all article element */
            const articleContainer = document.createElement('div');
            const buttonContainer = document.createElement('div');
            const article = document.createElement('article');
            const img = document.createElement('img');
            const h2 = document.createElement('h2');
            const span = document.createElement('span');
            const p = document.createElement('p');
            const LäsMer = document.createElement('a');

            /* add class */
            articleContainer.classList.add('article_container');
            buttonContainer.classList.add('button-container');
            LäsMer.classList = 'btn bg-Russian-Green text-Snow';

            /* add data to element */
            h2.textContent = "Två rum ";
            span.textContent = rum.name;
            p.textContent = rum.description
            img.src = `img/${rum.url}`
            LäsMer.textContent = "Läs mer";
            LäsMer.href = `rum.php?rum=${rum.room_id}`

            /* append */
            article.appendChild(img);
            articleContainer.appendChild(h2);
            h2.appendChild(span)
            articleContainer.appendChild(p);
            buttonContainer.appendChild(LäsMer);
            articleContainer.appendChild(buttonContainer);
            article.appendChild(articleContainer);

            boende.appendChild(article);
        });
    })
