migrate:
	cat ./.conf/postgresql/postgresql-dump.sql | docker-compose exec -T postgres-db psql --user=admin ratedb
.PHONY: migrate

say-hi:
	echo "hi"
.PHONY: say-hi