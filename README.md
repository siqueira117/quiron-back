<div align="center">
    <img src="https://i.imgur.com/3vzARPp.png">
    <p>Sistema de gerenciamento de entregas e catálogo de produtos para farmácias!</p>
    <a href="https://www.php.net/">
      <img src="https://img.shields.io/badge/php-v8.3.1-purple">
    </a>
    <a href="https://nodejs.org/pt">
      <img src="https://img.shields.io/badge/node-v18.13.0-green">
    </a>
    <a href="https://react.dev/">
      <img src="https://img.shields.io/badge/react-v18.3.1-blue">
    </a>
</div>

# Indice
- [Setup do projeto](#setup-do-projeto)
- [Banco de dados](#banco-de-dados)

# Setup do projeto

## Dependências
- PHP
- Node
- Composer

## Setup do Apache
Para o ambiente funcionar como o esperado, é preciso alterar as configurações do Apache na máquina local.
No arquivo "httpd.conf", é necessário alterar os campos "DocumentRoot" e "Directory", como podem observar na imagem.
Em ambos os campos, deve ser informado o path para a pasta "public" dentro do projeto.

![demo](https://i.imgur.com/g6B93nz.png)
 
## Executando o projeto
O projeto utiliza Laravel para o tratamento de rotas e dados e React para o desevolvimento das telas.
Levando em consideração que tenha instalado todas as dependencias listadas, basta executar os seguintes comandos na raiz do projeto: 
```    
$ composer install
```

Todas as dependencias do PHP serão instaladas.
Após isso, execute o comando abaixo para instalar as dependencias do Node.
```
$ npm install
```

E para executar o react, execute o comando abaixo:
```
$ npm run dev
```

Obs: para executar as rotas de backend, basta iniciar o Apache, pois a configuração foi realizada [anteriormente](#setup-do-apache).

E prontinho, projeto sendo executado!

![demo](https://i.imgur.com/cJc9dPY.png)

# Banco de dados

Utilizamos arquitetura Multi-Tenant, sendo assim, e em seu uso prático cada cliente terá seu próprio banco de dados e rotas de API.
Cada cliente cadastrado tem seu próprio ambiente, com subdominio disponivel. 
Por exemplo:

```
pacheco.quironex.com.br
```

## Cadastro de rotas

As rotas padrões do sistema Quiron devem ser cadastradas no arquivo:
```
routes/api.php
```

Já as rotas ligadas aos clientes, devem ser cadastradas no arquivo:
```
routes/tenant.php
```

Assim, conseguimos separar as rotas dos clientes e rotas ligadas ao sistema padrão.
As rotas ficam disponiveis da seguinte forma:

Padrão:
```
quironex.com.br/api/farmacia/store
```

Tenant:
```
pacheco.quironex.com.br/api/produto/store
```