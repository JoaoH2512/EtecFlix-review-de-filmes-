// script-netflix.js - Funcionalidades Netflix Style

document.addEventListener('DOMContentLoaded', function() {
    // Header scroll effect
    const header = document.querySelector('header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Modal de Avaliação
    const modalAvaliacao = document.getElementById('modal-avaliacao');
    const btnAvaliar = document.querySelectorAll('.btn-avaliar');
    const modalClose = document.querySelectorAll('.modal-close, .modal-cancel');
    const filmeIdInput = document.getElementById('filme-id');
    const btnEnviarAvaliacao = document.getElementById('btn-enviar-avaliacao');

    // Modal Adicionar Filme (Admin)
    const modalAdicionarFilme = document.getElementById('modal-adicionar-filme');
    const btnAdicionarFilme = document.getElementById('btn-adicionar-filme');

    // Abrir modal de avaliação
    btnAvaliar.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const filmeCard = this.closest('.filme-card');
            const filmeId = filmeCard.getAttribute('data-filme-id');
            filmeIdInput.value = filmeId;
            modalAvaliacao.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Abrir modal adicionar filme (admin)
    if (btnAdicionarFilme) {
        btnAdicionarFilme.addEventListener('click', function() {
            modalAdicionarFilme.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    // Fechar modais
    modalClose.forEach(btn => {
        btn.addEventListener('click', function() {
            modalAvaliacao.classList.remove('active');
            if (modalAdicionarFilme) {
                modalAdicionarFilme.classList.remove('active');
            }
            document.body.style.overflow = 'auto';
        });
    });

    // Fechar modal clicando fora
    window.addEventListener('click', function(e) {
        if (e.target === modalAvaliacao) {
            modalAvaliacao.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        if (modalAdicionarFilme && e.target === modalAdicionarFilme) {
            modalAdicionarFilme.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });

    // Enviar avaliação
    if (btnEnviarAvaliacao) {
        btnEnviarAvaliacao.addEventListener('click', function() {
            const form = document.getElementById('form-avaliacao');
            const rating = form.querySelector('input[name="rating"]:checked');
            const comentario = form.querySelector('#comentario').value;

            if (!rating) {
                alert('Por favor, selecione uma avaliação com estrelas.');
                return;
            }

            // Simular envio (substituir por AJAX no backend)
            alert(`Avaliação enviada!\nNota: ${rating.value} estrelas\nComentário: ${comentario || 'Sem comentário'}`);
            
            // Fechar modal
            modalAvaliacao.classList.remove('active');
            document.body.style.overflow = 'auto';
            
            // Limpar formulário
            form.reset();
        });
    }

    // Sistema de estrelas interativo
    const ratingInputs = document.querySelectorAll('.rating-input input');
    ratingInputs.forEach(input => {
        input.addEventListener('change', function() {
            const labels = this.closest('.rating-input').querySelectorAll('label');
            labels.forEach(label => {
                label.style.color = 'var(--netflix-gray)';
            });
            
            // Colorir estrelas selecionadas
            let current = this;
            while (current) {
                const label = current.nextElementSibling;
                if (label && label.tagName === 'LABEL') {
                    label.style.color = 'var(--netflix-red)';
                }
                current = current.previousElementSibling;
            }
        });
    });

    // Efeito de digitação no hero (Netflix style)
    const heroTitle = document.querySelector('.hero-content h1');
    if (heroTitle && window.location.pathname.includes('index.php')) {
        const text = heroTitle.textContent;
        heroTitle.textContent = '';
        heroTitle.classList.add('netflix-intro');
        
        let i = 0;
        function typeWriter() {
            if (i < text.length) {
                heroTitle.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        }
        
        setTimeout(typeWriter, 500);
    }

    // Validação de formulários
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validação básica
            const inputs = this.querySelectorAll('input[required], textarea[required]');
            let valid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.style.borderColor = 'var(--netflix-red)';
                    valid = false;
                } else {
                    input.style.borderColor = 'var(--netflix-gray)';
                }
            });
            
            if (valid) {
                // Simular envio (substituir por AJAX no backend)
                if (this.id === 'form-login') {
                    alert('Login realizado com sucesso! (Simulação)');
                    window.location.href = 'index.php';
                }
            } else {
                alert('Por favor, preencha todos os campos obrigatórios.');
            }
        });
    });

    // Animações de entrada Netflix
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);

    // Observar elementos para animação
    document.querySelectorAll('.filme-card, .card-custom, .table-container').forEach(el => {
        observer.observe(el);
    });

    // Efeito de hover nos cards
    const filmeCards = document.querySelectorAll('.filme-card');
    filmeCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });

    console.log('EtecFlix Netflix Style carregado com sucesso!');
});