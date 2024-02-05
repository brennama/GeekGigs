MET CSS 633
===========

GeekGigs Web Application
------------------------

## Setting Up Your Dev Environment (Mac Only)

### Install Docker Desktop
- Install Docker Desktop for Mac https://docs.docker.com/desktop/install/mac-install/.
- Open Docker Desktop. 
- Optionally close the dashboard screen when it pops up.
- Confirm Docker is running by clicking the Docker icon in the menu bar.

### Clone the Repository
- Open a new terminal window (or tab).
- Create the following local directory if it does not already exist:

```
# Check if directory exists
ls /var/www/html

# Create directory if it does not exist
mkdir -p /var/www/html

# Change working directory if it exists
cd /var/www/html
```

- Clone repository from GitHub with the following commands:

```
# Ensure your working directory is /var/www/html
pwd

# clone repo from github
git clone git@github.com:bgordenBU/geekgigs.git

# Change into project directory
cd geekgigs
```

### Bring Up Docker Containers
- Open a new terminal window (or tab).
- Change working directory to the following path:

```
cd /var/www/html/geekgigs/docker/development
```

- Execute the following commands:

```
# Build the containers
docker compose build

# Bring up the containers
docker compose up
```

- Executing `control^ + c` in your terminal window will bring down the containers. 
- Since the containers have already been built, you can simply bring them back up with `docker compose up`.  

**See below for more helpful Docker commands.**

### Run the Application Build Script
- Open a new terminal window (or tab).
- Execute a command on the app container:

```
docker exec -it app /bin/sh
```

- Once inside the container, change working directory:

```
cd /var/www/html/geekgigs
```

- Run the application build script with the environment flag:

```
php bin/build --env dev
```

- **Tip:** To see application build script options, run the following command:

```
php bin/build --help
```

- Optionally exit the container:

```
exit
```

### Run the Application

#### Browser
- In your browser, navigate to http://localhost:8080.

#### cURL
- Open a new terminal window (or tab).
- Execute one of the following cURL commands:

```
# Get JSON response (implicit)
curl 'http://localhost:8080/api/jobs'

# Get JSON response (explicit)
curl -XGET -H 'Accept: application/json' 'http://localhost:8080/api/jobs'

# Get JSON response with header information
curl -XGET -i -H 'Accept: application/json' 'http://localhost:8080/api/jobs'

# Get formatted JSON response (requires Python3, which Mac should include)
curl -XGET -H 'Accept: application/json' 'http://localhost:8080/api/jobs' | python3 -m json.tool
```
---

### Application Build Script Notes
:warning: The build script must be executed inside the `app` container.

```
# Access container shell
docker exec -it app /bin/sh

# Once inside the container, change directory
cd /var/www/html/geekgigs

# Execute build script for dev environment
php bin/build --env dev
```
---

### Helpful Docker Commands

All `docker compose` commands should be run locally from `/var/www/html/geekgigs/docker/development`.

```
# Build containers 
# (usually ran just once unless Docker config changes are made)
docker compose build

# Build containers without cache
docker compose build --no-cache

# Bring up containers
docker compose up

# Bring up containers in detached mode (runs in background)
docker compose up -d

# Bring down containers
docker compose down

# View running containers (and container ids)
docker ps

# View container logs
docker logs -f <CONTAINER ID>

# Access container shell
docker exec -it <NAME> /bin/sh

# Prune docker data
docker system prune --all
```
