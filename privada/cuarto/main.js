let noti = document.getElementById('news');

// Lista de términos de búsqueda que cambia en cada carga de página
const searchTerms = ['economía', 'política', 'deportes', 'cultura', 'salud'];

// Función para obtener el término de búsqueda aleatorio
function getRandomSearchTerm() {
    return searchTerms[Math.floor(Math.random() * searchTerms.length)];
}

// Función para obtener la fecha de hoy en formato 'YYYY-MM-DD'
function getTodayDate() {
    const today = new Date();
    return today.toISOString().split('T')[0];  // Formato: YYYY-MM-DD
}

function Api_con_axios() {
    // Usar un término aleatorio
    const searchTerm = getRandomSearchTerm();
    // Obtener la fecha de hoy
    const todayDate = getTodayDate();
    // Definir el país (Bolivia - "bo")
    const country = 'bo';

    axios({
        method: 'GET',
        url: `https://gnews.io/api/v4/search?q=${searchTerm}&lang=es&from=${todayDate}&sort_by=publishedAt&country=${country}&apikey=97f9fc61b9d31744be4eb6cc4b0f51d6`
    }).then(res => {
        let noticias = res.data.articles;
        console.log(noticias);

        // Limpiar el contenido anterior
        noti.innerHTML = '';

        // Crear una fila principal
        let row = document.createElement('div');
        row.classList.add('row', 'g-4');

        noticias.map((elemento) => {
            let col = document.createElement('div');
            col.classList.add('col-lg-4', 'col-md-6', 'col-sm-12');

            let div = document.createElement('div');
            div.classList.add('card', 'h-100');

            div.innerHTML = `
                <img src="${elemento.image}" class="card-img-top img-fluid" alt="Imagen noticia">
                <div class="card-body">
                    <h5 class="card-title">${elemento.title}</h5>
                    <p class="card-text">${elemento.description}</p>
                    <a href="${elemento.url}" class="btn btn-primary" target="_blank">Seguir leyendo</a>
                </div>
            `;

            col.appendChild(div);
            row.appendChild(col);
        });

        noti.appendChild(row);
    }).catch(error => {
        console.error('Error fetching the news:', error);
    });
}

Api_con_axios();
