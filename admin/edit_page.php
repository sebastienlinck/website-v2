<?php
require('auth.php');

require('functions.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Éditer la page</title>
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/section.css">

    <script>
        async function fetchSvgOptions(selectedSvg) {
            const response = await fetch('fetch_svgs.php');
            const svgs = await response.json();
            return svgs.map(svg => `
                <option value="${svg.path}" ${svg.path === selectedSvg ? 'selected' : ''}>${svg.name}</option>
            `).join('');
        }

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

        async function addSection(h3 = '', h4 = '', p = '', svg = '../img/hastag.svg', sectionNumber = null) {
            const sectionContainer = document.getElementById('sections');
            if (sectionNumber === null) {
                sectionNumber = sectionContainer.children.length + 1;
            }
            const svgOptions = await fetchSvgOptions(svg);
            const newSection = document.createElement('div');
            newSection.className = 'section';
            newSection.innerHTML = `
                <h2>Section ${sectionNumber}</h2>
                <input type="text" id="h3_${sectionNumber}" name="sections[${sectionNumber - 1}][h3]" value="${h3}" placeholder="Titre de la section."><br>
                <input type="text" id="h4_${sectionNumber}" name="sections[${sectionNumber - 1}][h4]" value="${h4}" placeholder="Sous-titre de la section."><br>
                <textarea id="p_${sectionNumber}" name="sections[${sectionNumber - 1}][p]" placeholder="Contenu de la section.">${p}</textarea><br>
                <select id="svg_${sectionNumber}" name="sections[${sectionNumber - 1}][svg]">
                    ${svgOptions}
                </select><br>
                
                <img class="move-up small" src="../img/icons/up_arrow.svg" onclick="sectionPlus(this.parentElement)">
                <img class="delete small" src="../img/icons/bin.svg" onclick="removeSection(this)">
                <img class="move-down small" src="../img/icons/down_arrow.svg"onclick="sectionMoins(this.parentElement)">
               
            `;
            sectionContainer.appendChild(newSection);
        }

        function removeSection(button) {
            button.parentElement.remove();
        }

        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const pageId = urlParams.get('page_id');
            document.getElementById('page_id').value = pageId;

            fetch('config.json')
                .then(response => response.json())
                .then(data => {
                    const page = data.find(p => p.id === pageId);
                    if (page) {
                        document.getElementById('page_name').value = page.name;
                        page.sections.forEach((section, index) => {
                            addSection(section.h3, section.h4, section.p, section.svg, index + 1);
                        });
                    }
                });
        });
    </script>
</head>

<body>

    <form action="save_config.php" method="POST">
        <div id="sections"></div>
        <div class="modal">
            <div class="modal-item">
                <input type="text" id="page_name" name="page_name" placeholder="Titre de la page" required><br><br>
            </div>
            <div class="modal-item">
                <input type="hidden" name="page_id" id="page_id" value="">
                <img onclick="addSection()" src="../img/icons/add.svg" alt="Ajout Section"><br><br>
                <input type="image" src="../img/icons/save.svg" alt="Submit" />
                <a href="pages.php"><img src="../img/icons/Back.svg" alt="Retour"></a> 
                <a href="main.php"><img src="../img/icons/home.svg" alt="Retour au menu principal"></a>
            </div>
        </div>
    </form>
</body>

</html>