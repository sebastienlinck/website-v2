//pour les pages :

function pagePlus(page) {
    const prevPage = page.previousElementSibling;
    if (prevPage) {
        page.parentNode.insertBefore(page, prevPage);
    }
}

function pageMoins(page) {
    const nextPage = page.nextElementSibling;
    if (nextPage) {
        page.parentNode.insertBefore(nextPage, page);
    }
}


function saveOrder() {
    const listItems = document.querySelectorAll('ul li');
    const order = Array.from(listItems).map((li, index) => ({
        id: li.dataset.id,
        order: index
    }));

    fetch('functions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(order)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur lors de la mise à jour de l'ordre des pages.");
            }
            return response.json();
        })
        .then(data => {
            alert('Ordre des pages sauvegardé avec succès.');
            location.reload();
        })

}



//pour les sections :

function sectionPlus(section) {
    const prevSection = section.previousElementSibling;
    if (prevSection) {
        section.parentNode.insertBefore(section, prevSection);
    }
}

function sectionMoins(section) {
    const nextSection = section.nextElementSibling;
    if (nextSection) {
        section.parentNode.insertBefore(nextSection, section);
    }
}

function removeSection(button) {
    button.parentElement.remove();
}
function addSectionConfig(h3 = '', h4 = '', p = '', svg = '../img/hastag.svg') {
    const sectionContainer = document.getElementById('sections');
    const sectionCount = sectionContainer.children.length;
    const newSection = document.createElement('div');
    newSection.className = 'section';
    newSection.innerHTML = `
<h2>Section ${sectionCount + 1}</h2>
    <input type="text" id="h3_${sectionCount}" name="sections[${sectionCount}][h3]" value="${h3}" placeholder="Titre de la section."><br>
    <input type="text" id="h4_${sectionCount}" name="sections[${sectionCount}][h4]" value="${h4}"  placeholder="Sous-titre de la section."><br>
    <textarea id="p_${sectionCount}" name="sections[${sectionCount}][p]" placeholder="Contenu de la section.">${p}</textarea><br>
    <select id="svg_${sectionCount}" name="sections[${sectionCount}][svg]">
        ${svgOptions}
    </select><br>
    <img class="move-up small" src="../img/icons/up_arrow.svg" onclick="sectionPlus(this.parentElement)">
    <img class="delete small" src="../img/icons/bin.svg" onclick="removeSection(this)">
    <img class="move-down small" src="../img/icons/down_arrow.svg" onclick="sectionMoins(this.parentElement)">
    `;
    sectionContainer.appendChild(newSection);
}

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const pageId = urlParams.get('page_id');
    document.getElementById('page_id').value = pageId;
    if (pageId) {
        fetch('config.json')
            .then(response => response.json())
            .then(data => {
                const page = data.find(p => p.id === pageId);
                if (page) {
                    document.getElementById('page_name').value = page.name;
                    page.sections.forEach(section => {
                        addSection(section.h3, section.h4, section.p, section.svg);
                    });
                }
            });
    }
});

// contact page :

function afficherCarte(address) {
    fetch('https://nominatim.openstreetmap.org/search?format=json&limit=1&q=' + encodeURIComponent(address))
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.length > 0) {
                var latitude = parseFloat(data[0].lat);
                var longitude = parseFloat(data[0].lon);
                var map = L.map('map').setView([latitude, longitude], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);
                L.marker([latitude, longitude]).addTo(map)
                    .bindPopup("C'est moi là !")
                    .openPopup();
            } else {
                console.error('Adresse introuvable');
            }
        })
        .catch(function(error) {
            console.error('Erreur:', error);
        });
}

document.getElementById('addressForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let address = document.getElementById('address').value;
    afficherCarte(address);
});
