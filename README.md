# ApiMyContacts

-> Para criar migration:
    vendor/bin/phinx create Create{....}Table
-> Para rodar migration:
    vendor/bin/phinx migrate



PARA start da aplicação!
php -S localhost:8000 -t public   

api-silex/
├── config/
│   ├── config.php        # Configurações gerais
│   ├── database.php      # Configurações do banco de dados
├── public/
│   └── index.php         # Arquivo de entrada
├── src/
│   ├── Controllers/      # Controladores
│   ├── Models/           # Modelos
│   └── Services/         # Serviços (opcional)
├── migrations/           # Arquivos de migrations do Phinx
├── composer.json
└── phinx.php             # Configuração do Phinx
