-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS etecflix;
USE etecflix;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('comum', 'admin') DEFAULT 'comum',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
);

-- Tabela de filmes
CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    titulo_original VARCHAR(200),
    ano_lancamento YEAR,
    duracao INT, -- em minutos
    genero VARCHAR(100),
    diretor VARCHAR(150),
    elenco TEXT,
    sinopse TEXT,
    poster_url VARCHAR(500),
    trailer_url VARCHAR(500),
    classificacao VARCHAR(10),
    data_adicionado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
);

-- Tabela de avaliações
CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    nota DECIMAL(2,1) NOT NULL CHECK (nota >= 1 AND nota <= 5),
    comentario TEXT,
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    editado BOOLEAN DEFAULT FALSE,
    data_edicao TIMESTAMP NULL,
    ativo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (filme_id) REFERENCES filmes(id) ON DELETE CASCADE,
    UNIQUE KEY unique_avaliacao (usuario_id, filme_id)
);

-- Tabela de favoritos
CREATE TABLE favoritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    data_adicionado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (filme_id) REFERENCES filmes(id) ON DELETE CASCADE,
    UNIQUE KEY unique_favorito (usuario_id, filme_id)
);

-- Tabela para logs de atividades
CREATE TABLE logs_ativadades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    acao VARCHAR(100) NOT NULL,
    descricao TEXT,
    tabela_afetada VARCHAR(50),
    registro_id INT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    data_log TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Inserir usuário administrador padrão
-- Senha: admin123 (criptografada com bcrypt)
INSERT INTO usuarios (nome, email, usuario, senha, tipo) VALUES 
('Administrador', 'admin@etecflix.com', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Inserir alguns usuários de exemplo
INSERT INTO usuarios (nome, email, usuario, senha) VALUES 
('João Silva', 'joao.silva@email.com', 'joao.silva', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Maria Oliveira', 'maria.oliveira@email.com', 'maria.oliveira', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Pedro Santos', 'pedro.santos@email.com', 'pedro.santos', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Inserir filmes de exemplo
INSERT INTO filmes (titulo, titulo_original, ano_lancamento, duracao, genero, diretor, elenco, sinopse, poster_url, classificacao) VALUES 
('Homem-Aranha: Sem Volta para Casa', 'Spider-Man: No Way Home', 2021, 148, 'Ação, Aventura, Ficção Científica', 'Jon Watts', 'Tom Holland, Zendaya, Benedict Cumberbatch, Jacob Batalon', 'Peter Parker precisa lidar com as consequências da sua identidade como o herói mais querido do mundo após ter sido revelada pela reportagem do Clarim Diário, com uma gravação enganosa feita por Mysterio no filme anterior. Incapaz de separar sua vida normal das aventuras de ser um super-herói, Parker pede ao Doutor Estranho para que todos esqueçam sua identidade. O feitiço, no entanto, sai muito mal e acaba unintencionalmente abrindo as portas do multiverso, permitindo que vilões de outras realidades alternativas chegassem ao seu universo.', 'https://via.placeholder.com/300x450/007bff/ffffff?text=Homem-Aranha', '12'),

('Avatar: O Caminho da Água', 'Avatar: The Way of Water', 2022, 192, 'Ficção Científica, Aventura', 'James Cameron', 'Sam Worthington, Zoe Saldana, Sigourney Weaver, Kate Winslet', 'Sequência de Avatar (2009) que continua a história de Jake Sully e Neytiri. Desta vez, a história acompanha a família Sully (Jake, Neytiri e seus filhos) e os perigos que os perseguem, os esforços que fazem para se manterem seguros, as batalhas que travam para permanecerem vivos e as tragédias que suportam.', 'https://via.placeholder.com/300x450/dc3545/ffffff?text=Avatar', '12'),

('Top Gun: Maverick', 'Top Gun: Maverick', 2022, 130, 'Ação, Drama', 'Joseph Kosinski', 'Tom Cruise, Miles Teller, Jennifer Connelly, Jon Hamm', 'Depois de mais de 30 anos de serviço como um dos principais aviadores da Marinha, Pete "Maverick" Mitchell está de volta, rompendo os limites como um piloto de testes corajoso. No mundo contemporâneo das guerras tecnológicas, Maverick enfrenta drones e prova que o fator humano ainda é essencial.', 'https://via.placeholder.com/300x450/28a745/ffffff?text=Top+Gun', '12'),

('The Batman', 'The Batman', 2022, 176, 'Ação, Crime, Drama', 'Matt Reeves', 'Robert Pattinson, Zoë Kravitz, Paul Dano, Jeffrey Wright', 'Após dois anos espreitando as ruas como Batman, Bruce Wayne se encontra nas profundezas mais sombrias de Gotham City. Com poucos aliados confiáveis, o vigilante solitário se estabelece como a personificação da vingança para a população.', 'https://via.placeholder.com/300x450/ffc107/000000?text=Batman', '14'),

('Duna', 'Dune', 2021, 155, 'Ficção Científica, Aventura', 'Denis Villeneuve', 'Timothée Chalamet, Rebecca Ferguson, Oscar Isaac, Zendaya', 'Paul Atreides é um jovem brilhante, dono de um destino além de sua compreensão. Ele deve viajar para o planeta mais perigoso do universo para garantir o futuro de seu povo.', 'https://via.placeholder.com/300x450/6f42c1/ffffff?text=Duna', '12'),

('Jurassic World: Domínio', 'Jurassic World: Dominion', 2022, 147, 'Ação, Aventura, Ficção Científica', 'Colin Trevorrow', 'Chris Pratt, Bryce Dallas Howard, Laura Dern, Sam Neill', 'Quatro anos após a destruição da Ilha Nublar, os dinossauros agora vivem - e caçam - ao lado de humanos em todo o mundo. Esse frágil equilíbrio remodelará o futuro e determinará, de uma vez por todas, se os seres humanos continuarão sendo os predadores de topo em um planeta que agora compartilham com as criaturas mais temíveis da história.', 'https://via.placeholder.com/300x450/fd7e14/ffffff?text=Jurassic', '12'),

('Doutor Estranho no Multiverso da Loucura', 'Doctor Strange in the Multiverse of Madness', 2022, 126, 'Ação, Aventura, Fantasia', 'Sam Raimi', 'Benedict Cumberbatch, Elizabeth Olsen, Chiwetel Ejiofor, Benedict Wong', 'O Doutor Estranho, com a ajuda de aliados místicos antigos e novos, atravessa as perigosas realidades alternativas e alucinantes do Multiverso para enfrentar um novo adversário misterioso.', 'https://via.placeholder.com/300x450/20c997/ffffff?text=Doutor+Estranho', '14'),

('Thor: Amor e Trovão', 'Thor: Love and Thunder', 2022, 119, 'Ação, Aventura, Comédia', 'Taika Waititi', 'Chris Hemsworth, Natalie Portman, Christian Bale, Tessa Thompson', 'Thor parte em uma jornada de autodescoberta, diferente de tudo que já enfrentou. Mas seus esforços são interrompidos por um assassino galáctico conhecido como Gorr, o Carniceiro dos Deuses, que busca a extinção dos deuses.', 'https://via.placeholder.com/300x450/e83e8c/ffffff?text=Thor', '12');

-- Inserir avaliações de exemplo
INSERT INTO avaliacoes (usuario_id, filme_id, nota, comentario) VALUES 
(2, 1, 5.0, 'Filme incrível! A melhor adaptação do Homem-Aranha até agora. A multiversalidade foi muito bem executada.'),
(3, 1, 4.5, 'Muito emocionante ver os atores antigos retornando. Fã service bem feito!'),
(2, 2, 4.0, 'Efeitos visuais espetaculares, mas a história é um pouco longa. James Cameron é gênio!'),
(3, 2, 3.5, 'Bonito de se assistir, mas esperava mais da trama. Ainda assim, entretenimento garantido.'),
(4, 3, 5.0, 'Tom Cruise não decepciona! Sequências aéreas realistas e emocionantes.'),
(2, 3, 4.5, 'Merece o Oscar! Filme de ação com alma e coração.'),
(3, 4, 4.0, 'Batman sombrio e investigativo como nos quadrinhos. Robert Pattinson surpreendeu!'),
(4, 4, 4.5, 'Gotham City nunca esteve tão viva. Fotografia incrível e atmosfera única.'),
(2, 5, 5.0, 'Obra-prima da ficção científica! Denis Villeneuve é um mestre.'),
(3, 5, 4.5, 'Visualmente deslumbrante. Fiel ao espírito do livro original.');

-- Inserir alguns favoritos
INSERT INTO favoritos (usuario_id, filme_id) VALUES 
(2, 1),
(2, 3),
(2, 5),
(3, 2),
(3, 4),
(4, 1),
(4, 6);

-- Criar índices para melhor performance
CREATE INDEX idx_filmes_titulo ON filmes(titulo);
CREATE INDEX idx_filmes_ano ON filmes(ano_lancamento);
CREATE INDEX idx_filmes_genero ON filmes(genero);
CREATE INDEX idx_avaliacoes_usuario ON avaliacoes(usuario_id);
CREATE INDEX idx_avaliacoes_filme ON avaliacoes(filme_id);
CREATE INDEX idx_avaliacoes_nota ON avaliacoes(nota);
CREATE INDEX idx_usuarios_email ON usuarios(email);
CREATE INDEX idx_usuarios_usuario ON usuarios(usuario);

-- View para média de avaliações por filme
CREATE VIEW filmes_com_media AS
SELECT 
    f.*,
    COALESCE(AVG(a.nota), 0) as media_avaliacao,
    COUNT(a.id) as total_avaliacoes
FROM filmes f
LEFT JOIN avaliacoes a ON f.id = a.filme_id AND a.ativo = TRUE
WHERE f.ativo = TRUE
GROUP BY f.id;

-- View para filmes mais populares (com mais avaliações)
CREATE VIEW filmes_populares AS
SELECT 
    f.*,
    COUNT(a.id) as total_avaliacoes,
    COALESCE(AVG(a.nota), 0) as media_avaliacao
FROM filmes f
LEFT JOIN avaliacoes a ON f.id = a.filme_id AND a.ativo = TRUE
WHERE f.ativo = TRUE
GROUP BY f.id
ORDER BY total_avaliacoes DESC, media_avaliacao DESC;

-- View para usuários mais ativos
CREATE VIEW usuarios_ativos AS
SELECT 
    u.*,
    COUNT(a.id) as total_avaliacoes,
    COUNT(fav.id) as total_favoritos
FROM usuarios u
LEFT JOIN avaliacoes a ON u.id = a.usuario_id AND a.ativo = TRUE
LEFT JOIN favoritos fav ON u.id = fav.usuario_id
WHERE u.ativo = TRUE
GROUP BY u.id;

-- Stored procedure para adicionar avaliação
DELIMITER //
CREATE PROCEDURE AdicionarAvaliacao(
    IN p_usuario_id INT,
    IN p_filme_id INT,
    IN p_nota DECIMAL(2,1),
    IN p_comentario TEXT
)
BEGIN
    DECLARE existing_id INT;
    
    -- Verificar se já existe avaliação
    SELECT id INTO existing_id 
    FROM avaliacoes 
    WHERE usuario_id = p_usuario_id AND filme_id = p_filme_id;
    
    IF existing_id IS NOT NULL THEN
        -- Atualizar avaliação existente
        UPDATE avaliacoes 
        SET nota = p_nota, 
            comentario = p_comentario,
            editado = TRUE,
            data_edicao = CURRENT_TIMESTAMP
        WHERE id = existing_id;
    ELSE
        -- Inserir nova avaliação
        INSERT INTO avaliacoes (usuario_id, filme_id, nota, comentario)
        VALUES (p_usuario_id, p_filme_id, p_nota, p_comentario);
    END IF;
END//
DELIMITER ;

-- Stored procedure para registrar log de atividade
DELIMITER //
CREATE PROCEDURE RegistrarLog(
    IN p_usuario_id INT,
    IN p_acao VARCHAR(100),
    IN p_descricao TEXT,
    IN p_tabela_afetada VARCHAR(50),
    IN p_registro_id INT,
    IN p_ip_address VARCHAR(45),
    IN p_user_agent TEXT
)
BEGIN
    INSERT INTO logs_ativadades (usuario_id, acao, descricao, tabela_afetada, registro_id, ip_address, user_agent)
    VALUES (p_usuario_id, p_acao, p_descricao, p_tabela_afetada, p_registro_id, p_ip_address, p_user_agent);
END//
DELIMITER ;

-- Trigger para log automático de inserção de filmes
DELIMITER //
CREATE TRIGGER after_filme_insert
AFTER INSERT ON filmes
FOR EACH ROW
BEGIN
    CALL RegistrarLog(NULL, 'INSERT_FILME', CONCAT('Novo filme adicionado: ', NEW.titulo), 'filmes', NEW.id, NULL, NULL);
END//
DELIMITER ;

-- Trigger para log automático de inserção de avaliações
DELIMITER //
CREATE TRIGGER after_avaliacao_insert
AFTER INSERT ON avaliacoes
FOR EACH ROW
BEGIN
    CALL RegistrarLog(NEW.usuario_id, 'INSERT_AVALIACAO', CONCAT('Nova avaliação para filme ID: ', NEW.filme_id), 'avaliacoes', NEW.id, NULL, NULL);
END//
DELIMITER ;

-- Exibir informações do banco criado
SELECT 'Banco de dados EtecFlix criado com sucesso!' as status;
SELECT COUNT(*) as total_usuarios FROM usuarios;
SELECT COUNT(*) as total_filmes FROM filmes;
SELECT COUNT(*) as total_avaliacoes FROM avaliacoes;