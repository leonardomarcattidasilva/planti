<h1>🌿 Planti</h1>
<p>Planti é uma aplicação web desenvolvida com CodeIgniter 4 para ajudar no gerenciamento do cuidado com plantas. Com ela, você pode cadastrar plantas, registrar cuidados, organizar tipos e acompanhar todas as atividades.</p>

<h2>🚀 Tecnologias Utilizadas</h2>
<ul>
   <li>PHP 8.x</li>
   <li>CodeIgniter 4</li>
   <li>MySQL</li>
   <li>Composer</li>
</ul>

<h3>📦 Instalação</h3>
<p>Siga os passos abaixo para rodar o projeto localmente.</p>

<h3>1. Clone o repositório</h3>
<p>git clone https://github.com/leonardomarcattidasilva/planti.git</p>
<p>cd planti</p>

<h3>2. Instale as dependências via Composer</h3>
<p>composer install</p>

<h3>3. Copie o arquivo de ambiente</h3>
<p><Renomeie o arquivo .env_example para .env com os dados de conexão com seu MySQL./p>
<p>Remova o comentário da linha de ambiente e o renomeie como production</p>
<b>CI_ENVIRONMENT = production</b>

<h3>3.1 No arquivo app/Config/Database faça:</h3>
   <p>'hostname' => 'ip_server'</p>
   <p>'username' => 'user'</p>
   <p>'password' => 'password'</p>
   <p>'database' => 'planti'</p>
   <p>'DBDriver' => 'MySQLi'</p>

<h3>4. Crie o banco de dados MySQL</h3>
<p>Acesse o MySQL e execute:</p>
<p>CREATE DATABASE planti</p>

<h3>4.1 - Populando o banco</h3>
   <p>Existem duas formas de popular o banco. Rodar as migrations ou utilizar um arquivo SQL. A primeira forma é rodar as migrations. Para isso faça: php spark migrate. A outra forma é utilizando o arquivo databank.sql </p>
   
<h3>5. Inicie o servidor local</h3>
<p>php spark serve --host ip_server --port port_number</p>
<p>Acesse no navegador: http://ip_server:port_number</p>

<h4>📚 Rotas da Aplicação</h4>
<h5>🔐 Autenticação</h5>
Método	Rota	Descrição
<p>GET	/login	Página de login</p>
<p>POST	/loginAction	Processa o login</p>
<p>GET	/logup	Página de cadastro</p>
<p>POST	/logupAction	Processa o cadastro</p>
<p>GET	/logout	Logout</p>


<h4>🌱 Plantas</h4>
<h5>Método Rota Descrição</h5>
<p>GET	/	Página inicial</p>
<p>GET	/cadastroPlanta	Formulário de cadastro de planta</p>
<p>POST	/cadastrar	Cadastra uma planta</p>
<p>GET	/planta	Lista de plantas</p>
<p>GET	/detalhes	Visualiza detalhes de uma planta</p>
<p>GET	/editar	Formulário de edição</p>
<p>POST	/updatePlanta	Atualiza dados da planta</p>
<p>GET	/deletar	Confirmação de exclusão</p>
<p>POST	/confirmadeletar	Deleta a planta</p>

<h4>🪴 Tipos de Planta</h4>
<h5>Método Rota Descrição</h5>
<p>GET	/tipos	Cadastro de tipos de planta</p>
<p>POST	/cadastrarTipo	Cadastra novo tipo</p>

<h4>💧 Cuidados</h4>
<h5>Método Rota Descrição</h5>
GET	/adicionarCuidados	Formulário de adicionar cuidado
POST	/cadastrarCuidado	Cadastra novo cuidado
GET	/editarCuidado	Página de edição de cuidado
POST	/updateCuidado	Atualiza dados do cuidado
GET	/deletarCuidado	Página de confirmação de exclusão
GET	/cuidadosTodas	Lista visual de todos os cuidados
POST	/cuidados	API para todos os cuidados
GET	/cuidadosTipos	Lista visual filtrada por tipo
POST	/cuidadosTipo	API para cuidados por tipo

<h4>✅ Outros</h4>
<h5>Método Rota Descrição</h5>
<p>GET	/done	Tela de confirmação</p>
<p>GET	/success	Mensagem de sucesso</p>

<h3>🧪 Testes</h3>
<p>Se houver testes implementados:</p>
php vendor/bin/phpunit

<h4>🙋 Contribuições</h4>
<p>Contribuições são muito bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request com melhorias.</p>

<h4>📄 Licença</h4>
<p>Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais informações.</p>