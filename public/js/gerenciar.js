modalBack = document.getElementsByClassName("modal");

$(document).ready(function () {
    listProjects();
    listPositions();

   $(document).on('click', '.modal', function(e){
    if(e.target == this){
        $(this).css("display", "none");
    }
    });

    $(document).on('click', '.btnChangePassword', function(){
        var modalId = $(this).data('modal-id');
        $('.modal-' + modalId).css('display', 'flex');

        $('.bodyDelete-' + modalId).css('display', 'none');
        $('.bodyReset-' + modalId).css('display', 'block');
    });

    $(document).on('click', '.btnDeleteWorker', function(){
        var modalId = $(this).data('modal-id');
        $('.modal-' + modalId).css('display', 'flex');

        $('.bodyDelete-' + modalId).css('display', 'block');
        $('.bodyReset-' + modalId).css('display', 'none');
    });
    
    $('.tab-btn').click(function() {
    var tabId = $(this).data('tab');

    // Remove ativo dos botões e conteúdos
    $('.tab-btn, .tab-content').removeClass('active');

    // Adiciona ativo no botão clicado e no conteúdo correspondente
    $(this).addClass('active');
        $('.tab-content[data-tab="' + tabId + '"]').addClass('active');
    });

    $(document).on('click', '.buttonsFormWorker button', function(e) {
        if ($(this).text().trim().toUpperCase() === 'CANCELAR') {
            e.preventDefault();
            $(this).closest('.modal').hide();
        }
    });

    $('input[name="cpf"]').on('input', function() {
        let cpf = $(this).val();

        cpf = cpf.replace(/\D/g, '');

        cpf = cpf.substring(0, 11);

        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
        cpf = cpf.replace(/(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4');

        $(this).val(cpf);
    });
})
//getWorkers
document.querySelector('.tab-btn[data-tab="2"]').addEventListener('click', function() {
    fetch('/utils/listWorker.php')
        .then(res => {
            if (!res.ok) throw new Error('Erro HTTP: ' + res.status);
            return res.text();
        })
        .then(html => {
            const container = document.querySelector('.tab-content[data-tab="2"]');
            if (container) {
                container.innerHTML = `
                    <h3>Funcionários</h3>
                    <form class="formNewWorker" method="POST" action="">
                        <div class="optNewWorker">
                            <label>Projeto</label>
                            <select class="optNewWorker selectProject" name="nameProject" required>
                                <option value="">Selecione</option>
                                <!-- Aqui pode colocar via backend ou via JS -->
                            </select>
                        </div>
                    </form>
                    ${html}
                `;
                listProjects();
            } else {
                console.error('Tab content não encontrado!');
            }
        })
        .catch(err => console.error('Erro ao carregar lista:', err));
});
//More fetch req
document.querySelector('.tab-btn[data-tab="3"]').addEventListener('click', function() {
    listProjects();
    listPositions();
});
function listProjects() {
    fetch('/actions/GenericAction.php?action=listProjects')
        .then(res => res.json())
        .then(data => {
            // 1) Atualiza .list-projects se existir
            const listContainer = document.querySelector('.list-projects');
            if (listContainer) {
                listContainer.innerHTML = ''; // Limpa

                data.data.forEach(project => {
                    listContainer.innerHTML += `
                        <div class="item">
                            <span>${project.nameProject} - ${project.timeProject}</span>
                            <form class="form-delete">
                                <input type="hidden" name="form_type" value="deleteProject">
                                <input type="hidden" name="idProject" value="${project.idProject}">
                                <button type="submit" class="btn-delete" data-type="project" data-id="${project.idProject}">Deletar</button>
                            </form>
                        </div>
                    `;
                });
            }

            // 2) Atualiza TODOS os selects .optNewWorker que EXISTEM
            const selects = document.querySelectorAll('select.selectProject');
            if (selects.length) {
                selects.forEach(select => {
                    // Limpa antes
                    select.innerHTML = '';

                    // Option padrão
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Selecione';
                    select.appendChild(defaultOption);

                    // Preenche com os projetos
                    data.data.forEach(project => {
                        const option = document.createElement('option');
                        option.value = project.idProject;
                        option.textContent = project.nameProject;
                        select.appendChild(option);
                    });
                });
            }
        })
        .catch(err => console.error('Erro ao listar projetos:', err));
}

function listPositions() {
    fetch('/actions/GenericAction.php?action=listPositions')
        .then(res => res.json())
        .then(data => {
            // Atualiza a lista visual
            const container = document.querySelector('.list-positions');
            container.innerHTML = ''; 
            data.data.forEach(jobPosition => {
                container.innerHTML += `
                    <div class="item">
                        <span>${jobPosition.namePosition}</span>
                        <form class="form-delete">
                            <input type="hidden" name="form_type" value="deletePosition">
                            <input type="hidden" name="idJobPosition" value="${jobPosition.idJobPosition}">
                            <button type="submit" class="btn-delete" data-type="position" data-id="${jobPosition.idJobPosition}">Deletar</button>
                        </form>
                    </div>
                `;
            });

            // Atualiza o <select>
            const select = document.querySelector('select[name="idJobPosition"]');
            if (select) {
                select.innerHTML = '<option value="">Selecione</option>';
                data.data.forEach(jobPosition => {
                    select.innerHTML += `<option value="${jobPosition.idJobPosition}">${jobPosition.namePosition}</option>`;
                });
            }
        })
        .catch(err => console.error('Erro ao listar cargos:', err));
}

// Adicionar Projeto
document.querySelector('.form-add-project').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('/actions/GenericAction.php?action=addProject', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            listProjects(); // Atualiza lista
            this.reset();
        } else {
            alert(data.message);
        }
    })
    .catch(err => console.error('Erro ao adicionar projeto:', err));
});

// Adicionar Cargo
document.querySelector('.form-add-position').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('/actions/GenericAction.php?action=addPosition', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            listPositions(); // Atualiza lista
            this.reset();
        } else {
            alert(data.message);
        }
    })
    .catch(err => console.error('Erro ao adicionar cargo:', err));
});
function deleteProject(idProject) {
    const formData = new FormData();
    formData.append('form_type', 'deleteProject');
    formData.append('idProject', idProject);

    fetch('/actions/GenericAction.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            console.log('Projeto deletado com sucesso!');
            listProjects();  // Atualiza a lista depois de deletar
        } else {
            console.error('Erro ao deletar projeto:', data.message);
        }
    })
    .catch(err => console.error('Erro na requisição de deletar projeto:', err));
}

function deletePosition(idJobPosition) {
    const formData = new FormData();
    formData.append('form_type', 'deletePosition');
    formData.append('idJobPosition', idJobPosition);

    fetch('/actions/GenericAction.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            console.log('Cargo deletado com sucesso!');
            listPositions(); // Atualiza a lista depois de deletar
        } else {
            console.error('Erro ao deletar cargo:', data.message);
        }
    })
    .catch(err => console.error('Erro na requisição de deletar cargo:', err));
}
document.addEventListener('click', function(e) {
    if (e.target.matches('.btn-delete')) {
        e.preventDefault();

        const type = e.target.dataset.type; // "project" ou "position"
        const id = e.target.dataset.id;

        if (type === 'project') {
            deleteProject(id);
        } else if (type === 'position') {
            deletePosition(id);
        }
    }
});


/* document.querySelector('.formNewWorker').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('/actions/GenericAction.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Exibe mensagem de sucesso ou erro
        const msgDiv = document.createElement('div');
        msgDiv.className = 'form-message ' + (data.success ? 'sucesso' : 'erro');
        msgDiv.textContent = data.message;
        
        form.parentNode.insertBefore(msgDiv, form);
        console.log(response);
        if (data.success) {
            // Alterna para a aba 2 após 1 segundo
            setTimeout(() => {
                $('.tab-btn, .tab-content').removeClass('active');
                $('.tab-btn[data-tab="2"]').addClass('active');
                $('.tab-content[data-tab="2"]').addClass('active');
            }, 1000);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});
 */
//not


/*
    $('.btnDelete').on('click', function(){
        var modalId = $(this).data('modal-id');
        $('.myModal-' + modalId).css('display', 'flex');
    });

    $('.myModal').on('click', function(e){
    if(e.target==this){
        $('.myModal').css("display", "none");
    }
    $('.btnCancel').on('click', function(){
        $('.myModal').css("display", "none");
    });

      $('input[name="profilepic"]').on('change', function(e) {
        // Obtém o caminho do arquivo selecionado
        var imagePath = URL.createObjectURL(e.target.files[0]);

        // Exibe a visualização da imagem no photo-container
        $('.photo-container img').attr('src', imagePath);
    });
    data-modal-id="<?=$row->id?>"
});
*/

