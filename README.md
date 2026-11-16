# ISLA Eventos

Plataforma Web para divulgação e gestão de workshops, palestras e hackathons do ISLA Gaia.

## Sobre o projeto
Este projeto foi desenvolvido no âmbito da Unidade Curricular de **Programação Web - Servidor I (PWS1)** do CTeSP de Desenvolvimento Web e Multimédia (DWDM) no ISLA Gaia.

## Instruções de instalação e arranque

```bash
# 1. Clonar o repositório
git clone [https://github.com/oteunome/isla-eventos.git](https://github.com/oteunome/isla-eventos.git)

# 2. Entrar na pasta do projeto
cd pws1-app

# 3. Instalar as dependências do Composer
composer install

# 4. Copiar o ficheiro de ambiente
cp .env.example .env

# 5. Gerar a chave da aplicação
php artisan key:generate

# 6. Iniciar o servidor local
php artisan serve