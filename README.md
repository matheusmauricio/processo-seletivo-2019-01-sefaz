PASSO A PASSO PARA FUNCIONAR (Laravel)

- É necessário executar o comando "composer update"
- É necessário que o arquivo "dataset-processo-seletivo-2019.csv" esteja na pasta "database"
- É precisar criar um arquivo vazio chamado "banco_sefaz.sqlite" na pasta "database"
- O arquivo .env com as configurações necessárias está disponível nesse projeto
- É necessário alterar o caminho até a pasta do projeto no arquivo .env na opção "DB_DATABASE"
- Antes de clicar na opção "Importar CSV" é necessário executar o comando "php artisan migrate" na pasta do projeto




Processo Seletivo 2019/01
Menor Preço
O objetivo do desafio é construir uma API para consulta e recuperação de uma lista de produtos, filtrada pelo GTIN e ordenada pelo preço. Você deve utilizar a base de dados de produtos fake disponibilizada no final da descrição.

Crie uma modelagem de banco de dados para o dataset fornecido uilizando um banco de dados sqlite para o desafio. Escolha a modelagem que seja a mais adequada para a solução.

Crie um mecanismo para realizar a importação dos dados do .csv para o .sqlite de forma dinâmica. Pode ser através de uma rota (GET /v1/importar) ou via Command (Laravel - "php artisan import:db")

Defina uma rota GET /v1/produtos onde será possível obter todos os produtos contidos no banco de dados. A rota deve receber como parâmetro um valor GTIN. Caso alguém tente acessar este endpoint sem esses parâmetro, o sistema deve retornar uma resposta 400 (Bad Request).

O endpoint deve retornar, em formato JSON, uma lista de produtos ordernados pelo preço (do menor para o maior valor). Nessa listagem deve ser informada uma url do Google Maps que redireciona para o ponto (utilizando latitude e longitude). Assim, em um cenário hipotético, um cliente que acessa o endpoint passando como argumento um produto (GTIN), receberia como resposta uma lista produtos. Além disso, a lista deve ser filtrada para que os produtos não tenham valor zerado e possuam latitude e longitude preenchidos, de forma que o cliente da API não receba na resposta nenhum produto em que não consiga visualizar o endereço no mapa. A localização de cada contribuinte pode ser encontrada no dataset fornecido nas colunas cod_latitude e cod_longitude. O corpo da resposta deve conter um atributo url para cada produto. Este atributo não deve pertencer à modelagem de banco de dados.

A tarefa deve ser implementada em PHP com a framework Laravel 5.6+ ou em .NET CORE 2.1+.

Para participar crie um repositório público (GIT) e envie e-mail para processo-seletivo-dev@sefaz.es.gov.br até dia 02/06/2019 contendo a URL do repositório.

Diferenciais
Criar um mecanismo para verificar a existência ou não dos parâmetros obrigatórios da API (ex: middleware).
Criar um mecanismo que realize um log de cada request, registrando o horário, o GTIN, o status code da requisição e o número de produtos retornados. Decida se o log será registrado em banco de dados ou em arquivo simples de texto.
Escrever um teste (ou conjunto de testes) que garanta o funcionamento esperado da API.
Permitir informar a latitude e longitude na rota de produtos e obter no retorno da API um atributo distância (em KM) do ponto informado até o endereço do estabelecimento. Este atributo não deve pertencer à modelagem de banco de dados, uma vez que trata-se de um atributo calculado em tempo real, de acordo com a localização de cada cliente.
Cargo
Salário: R$2.412,94.

Benefícios:

Auxílio alimentação R$17,16 por dia;

Plano de saúde participativo Sulamerica.