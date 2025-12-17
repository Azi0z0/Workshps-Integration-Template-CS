pipeline {
    agent any

    environment {
        SONARQUBE_ENV = 'sonarqube-local'
    }

    stages {

        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Install dependencies') {
            steps {
                sh 'composer install --no-interaction'
            }
        }

        stage('Unit tests') {
            steps {
                sh 'php bin/phpunit'
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv("${SONARQUBE_ENV}") {
                    sh """
                    sonar-scanner \
                      -Dsonar.projectKey=workshops-integration \
                      -Dsonar.sources=src \
                      -Dsonar.host.url=http://localhost:9000
                    """
                }
            }
        }
    }
}

