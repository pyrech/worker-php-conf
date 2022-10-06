# Des workers PHP avec systemd et Symfony Messenger

Application de démo pour la conférence donnée au Forum PHP 2022.

## Installer le projet

```bash
docker-compose up -d
composer install
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
```

## Envoyer un message dans la file d'attente

```bash
bin/console app:check-url 
```

## Gestion des workers

### A la main

Pour démarrer :

```bash
bin/console messenger:consume async
```

CTRL + C pour terminer la commande.

### Avec systemd

Installer et démarrer l'unit :

```bash
ln -s messenger-worker.service /etc/systemd/system/worker-messenger-forumphp.service
systemctl start worker-messenger-forumphp.service
```

Recharger systemd en cas de modif sur la configuration de votre unit :

```bash
systemctl daemon-reload
```

Stopper et désinstaller l'unit :

```bash
systemctl stop worker-messenger-forumphp.service
rm /etc/systemd/system/worker-messenger-forumphp.service
```

## Forcer l'arrêt des workers

```bash
bin/console messenger:stop-workers --env=prod
```

Pour rappel, si le service est géré via systemd, les workers seront redémarrés automatiquement.
