up:
	./vendor/bin/sail up -d
	./vendor/bin/sail npm run dev
stop:
	./vendor/bin/sail stop
down:
	./vendor/bin/sail down
destroy:
	./vendor/bin/sail down --rmi all --volumes --remove-orphans
fresh:
	./vendor/bin/sail artisan migrate:fresh --seed
migrate:
	./vendor/bin/sail artisan migrate
seed:
	./vendor/bin/sail artisan db:seed
