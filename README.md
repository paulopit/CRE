# Projeto-Final---EFA-Cesae

## Aplicativo Web - Gestão de Requisições de Equipamentos

## Equipa S
 - Paulo Pinto

## Requisitos: 

- Portal com página de login e registo
- Backoffice de gestão de utilizadores, equipamentos e requisições.
- 3 tipos de utilizadores (Administrador, Técnico e Utilizador).
- Conta de Administrador com acessos totais.
- Requisições podem ser efetuadas por utilizadores ou técnicos.
- Painel de gestão de utilizadores para o administrador
- Painel de submissão e visualização de requisições com vários filtros de estado para os técnicos.
- Técnicos gerem requisições
- Técnicos podem alterar requisições ainda por aprovar.
- Utilizador pode cancelar requisições ainda por aprovar.
- Campo de referência e serial number para equipamentos é opcional.
- Mostra stock disponivel para requisição aos utilizadores.
- Requisições por aprovar reservam stock.
- Envio de notificação para o utilizador quando a requisição não é aprovada.
- Envio de notificações para requisições expiradas e para stock reduzido.
- Parametro para definir email de alertas.
- Parametro de stock baixo por percentagem.
- Importar equipamentos em massa, folha excel.
- Gestão via Webservice (Segundo Plano).
- Utilizar cores do cesae no layout.


## :rotating_light: To Do:



## :white_check_mark: Done:
- [x] Middlewares 
- [x] Migrations completas
- [x] Página Login
- [x] Página Registo
- [x] Criar projeto. 
- [x] Integrar AdminLTE. 
- [x] Permissões Gate 
- [x] Menus AdminLTE 
- [x] Datatables AdminLTE
- [x] Modo Tabs AdminLTE
- [x] Sistema de traduções
- [x] Configuração de timezone para Portugal
- [x] Função de leitura de parametros AppConfig 
- [x] Integração de Envio Email. 
- [x] Criado middleware 'management' 
- [x] Página gestão de conta para utilizadores 
- [x] Página gestão contas para Administrador 
- [x] Página gestão de tipos de utilizador 
- [x] Página gestão de funções de utilizador 
- [x] Página gestão de parametros da APP 
- [x] CRUD UserFunction 
- [x] CRUD UserType 
- [x] CRUD AppConfig
- [x] CRUD UserAccount
- [x] AppConfigSeeder
- [x] Página pedidos de requisições (FrontEnd User) 
- [x] Página gestão de requisições (BackEnd User) 
- [x] Seeds
- [X] CRUD
- [x] Página gestão de Marcas e Modelos
- [x] Página gestão de Equipamentos
- [x] Triggers envio de Emails.
- [x] Importação de equipamentos via ficheiro Excel
- [x] Webservice [Opcional]
- [x] Ajuste CSS
- [x] Testes Funcionais
- [x] Criar Documentação
- [x] Botão extender requisição [Opcional]
- [x] Validar traduções
- [x] Adicionar forma de controlar estados de entrega e devolução dos equiapamentos (Equip_lines)
- [x] Ao editar/criar equipamento com uma referencia, atualizar as descrições dos equip com mesma ref.
- [x] Nos users, listar requisicoes de cada utilizador (em Aberto / Fechadas, paginacao 5)
- [x] Nos equipamentos ter possibilidade de listar historico (por onde o equipamento andou).
- [x] Possibilidade de Tecnico editar requisicoes por aprovar.
- [x] Adicionar separador para Tecnico/Admin a mostrar todas as requisicoes (não mostrar level_id 5 expiradas).




## Exemplos:
Chamar parametros da AppConfig nos templates blade:
```php
{{ App\App_config::GetAppConfig() }}
```

Incluir os alertas nas páginas:
Na linha seguinte à @section('content')

```php
@include('sweetalert::alert')
```

Adicionar traduções nas tabelas

```php
$config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
 :config="$config"  <- adicionar na tabela
```



