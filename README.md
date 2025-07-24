🌿 Planti
Planti é uma aplicação web desenvolvida com CodeIgniter 4 para ajudar no gerenciamento do cuidado com plantas. Com ela, você pode cadastrar plantas, registrar cuidados, organizar tipos e acompanhar todas as atividades.

🚀 Tecnologias Utilizadas
PHP 8.x
CodeIgniter 4
MySQL
Composer
📦 Instalação
Siga os passos abaixo para rodar o projeto localmente.

1. Clone o repositório
git clone https://github.com/leonardomarcattidasilva/planti.git
cd planti

2. Instale as dependências via Composer
composer install

3. Copie o arquivo de ambiente
Renomeie o arquivo .env_example para .env com os dados de conexão com seu MySQL:
Remova o comentário da linha de ambiente e o renomeie como production
CI_ENVIRONMENT = production

3.1 No arquivo app/Config/Database faça: 

   public array $default = [
      'DSN'          => '',
      'hostname'     => 'ip_server',
      'username'     => 'user',
      'password'     => 'password',
      'database'     => 'planti',
      'DBDriver'     => 'MySQLi',
      'DBPrefix'     => '',
      'pConnect'     => false,
      'DBDebug'      => true,
      'charset'      => 'utf8mb4',
      'DBCollat'     => 'utf8mb4_general_ci',
      'swapPre'      => '',
      'encrypt'      => false,
      'compress'     => false,
      'strictOn'     => false,
      'failover'     => [],
      'port'         => 3306,
      'numberNative' => false,
      'foundRows'    => false,
      'dateFormat'   => [
         'date'     => 'Y-m-d',
         'datetime' => 'Y-m-d H:i:s',
         'time'     => 'H:i:s',
      ],
   ];

4. Crie o banco de dados MySQL
Acesse o MySQL e execute:
CREATE DATABASE planti;

4.1 - Populando o banco
   Existem duas formas de popular o banco. Rodar as migrations ou utilizar um arquivo SQL.
   A primeira forma é rodar as migrations. Para isso faça: php spark migrate
   A outra forma é utilizando o arquivo databank.sql 
   

6. Inicie o servidor local
php spark serve --host ip_server --port port_number
Acesse no navegador: http://ip_server:port_number

📚 Rotas da Aplicação
🔐 Autenticação
Método	Rota	Descrição
GET	/login	Página de login
POST	/loginAction	Processa o login
GET	/logup	Página de cadastro
POST	/logupAction	Processa o cadastro
GET	/logout	Logout

🌱 Plantas
Método	Rota	Descrição
GET	/	Página inicial
GET	/cadastroPlanta	Formulário de cadastro de planta
POST	/cadastrar	Cadastra uma planta
GET	/planta	Lista de plantas
GET	/detalhes	Visualiza detalhes de uma planta
GET	/editar	Formulário de edição
POST	/updatePlanta	Atualiza dados da planta
GET	/deletar	Confirmação de exclusão
POST	/confirmadeletar	Deleta a planta

🪴 Tipos de Planta
Método	Rota	Descrição
GET	/tipos	Cadastro de tipos de planta
POST	/cadastrarTipo	Cadastra novo tipo

💧 Cuidados
Método	Rota	Descrição
GET	/adicionarCuidados	Formulário de adicionar cuidado
POST	/cadastrarCuidado	Cadastra novo cuidado
GET	/editarCuidado	Página de edição de cuidado
POST	/updateCuidado	Atualiza dados do cuidado
GET	/deletarCuidado	Página de confirmação de exclusão
GET	/cuidadosTodas	Lista visual de todos os cuidados
POST	/cuidados	API para todos os cuidados
GET	/cuidadosTipos	Lista visual filtrada por tipo
POST	/cuidadosTipo	API para cuidados por tipo

✅ Outros
Método	Rota	Descrição
GET	/done	Tela de confirmação
GET	/success	Mensagem de sucesso

🧪 Testes
Se houver testes implementados:

bash
Copiar
Editar
php vendor/bin/phpunit
🙋 Contribuições
Contribuições são muito bem-vindas! Sinta-se à vontade para abrir uma issue ou enviar um pull request com melhorias.

📄 Licença
Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais informações.