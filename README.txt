Migration includes creation of the initial data - 2 divisions and 16 teams. This was made in order not to spend time
on creation of these objects with standard CRUD.

The whole competition was split into stages (group, quarterfinal, semifinal, final). Each stage has own page with
results, manager class containing base logic and generator which is responsible for generation of game results.

Probably, controllers could be organized in a better way, but I wanted to implement 'clean' abstract factory without
usage of symfony's DI container factory.

Passing results from manager to generator as arrays (method \App\Service\StageManager\StageManagerInterface::findStageWinners)
doesn't look like a best practices of OOP. Unfortunately, I didn't have enough to do it a better way. There should a
special interface and implementation for group and play-off stages. This interface would be used as return type of
\App\Service\StageManager\StageManagerInterface::findStageWinners

1. Run next commands from the project root directory
  'cp docker-compose.example.yml docker-compose.yml'
  'cp .env.example .env'
  'docker-compose up -d'
  'docker-compose exec php composer install'
2. In file symfony-app/.env replace database credentials with below
  DATABASE_URL=mysql://root:password@mariadb:3306/competition?serverVersion=mariadb-10.5.5
3. Install database schema
  'docker-compose exec php bin/console doctrine:migrations:migrate'
4. Start usage of the app from page /stage/group.