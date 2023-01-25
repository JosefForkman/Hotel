const cardWrapper = document.querySelector('.card-wrapper');
const title = document.querySelector('.vacation-title').querySelector('h2');
const revenueH4 = document.querySelector('.revenue');

console.log(title);

fetch('API/logbook/logbook.json')
    .then((response) => response.json())
    .then((data) => {
        data.vacation.forEach((vacation) => {
            // vacation = JSON.parse(vacation);

            const arrivalDate = vacation.arrival_date;
            const departureDate = vacation.departure_date;
            const island = vacation.island;
            const hotel = vacation.hotel;

            const card = document.createElement('div');
            card.classList.add('card');
            const h4 = document.createElement('h4');

            const dates = arrivalDate + ' - ' + departureDate;

            h4.textContent = dates;
            h4.classList.add('text-Amaranth-Purplen');
            cardWrapper.appendChild(card);
            card.appendChild(h4);

            const islandSpan = document.createElement('p');
            const hotelSpan = document.createElement('p');

            const islandDiv = document.createElement('div');

            const islandPrefix = document.createElement('span');
            islandPrefix.textContent = 'Island: ';
            islandSpan.textContent = island;

            card.appendChild(islandDiv);
            islandDiv.appendChild(islandPrefix);
            islandDiv.appendChild(islandSpan);

            const hotelDiv = document.createElement('div');

            const hotelPrefix = document.createElement('span');
            hotelPrefix.textContent = 'Hotel: ';
            hotelSpan.textContent = hotel;

            card.appendChild(hotelDiv);
            islandDiv.appendChild(hotelPrefix);
            islandDiv.appendChild(hotelSpan);

            const spanPrefix = document.createElement('span');
            spanPrefix.textContent = 'Booked features: ';
            card.appendChild(spanPrefix);

            vacation.features.forEach((feature) => {
                feature = feature.name;
                console.log(feature);

                const spanSuffix = document.createElement('p');

                spanSuffix.textContent = feature;

                card.appendChild(spanSuffix);
            });
        });
    });
