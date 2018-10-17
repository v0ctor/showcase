pipeline {
  agent any

  environment {
    VENDOR = 'v0ctor'
    PROJECT = 'showcase'

    REGISTRY = 'docker.victordiaz.me'
    REGISTRY_CREDENTIALS = credentials('docker-registry')

    NAMESPACE = 'cd'
  }

  stages {
    stage('Prepare') {
      steps {
        script {
          BUILD = sh (script: "git rev-parse --short HEAD | tr -d '\n'", returnStdout: true)
          IMAGE = [REGISTRY, VENDOR, PROJECT].join('/') + ":${BUILD}"
        }
      }
    }

    stage('Bundle') {
      when {
        anyOf {
          branch 'master'
          branch 'develop'
        }
      }
      steps {
        sh "docker build -t ${IMAGE} ."

        sh "echo ${REGISTRY_CREDENTIALS_PSW} | docker login ${REGISTRY} -u ${REGISTRY_CREDENTIALS_USR} --password-stdin"
        sh "docker push ${IMAGE}"
      }
    }

    stage('Deploy') {
      when {
        anyOf {
          branch 'master'
          branch 'develop'
        }
      }
      steps {
        script {
          PACKAGE = [VENDOR, PROJECT].join('-')
          DEPLOYMENT_NAMESPACE = env.BRANCH_NAME == 'master' ? 'production' : 'staging'
        }

        sh 'kubectl create configmap {package}-web --from-file=docker/web --dry-run=true --output=yaml > kubernetes/config-web.yml'

        sh "find kubernetes -type f | xargs sed -i 's,{vendor},${VENDOR},'"
        sh "find kubernetes -type f | xargs sed -i 's,{package},${PACKAGE},'"
        sh "find kubernetes -type f | xargs sed -i 's,{image},${IMAGE},'"
        sh "find kubernetes -type f | xargs sed -i 's,{build},${BUILD},'"

        sh """
          kubectl apply \
            -n ${DEPLOYMENT_NAMESPACE} \
            -f kubernetes/${DEPLOYMENT_NAMESPACE}/ingress.yml \
            -f kubernetes/service.yml \
            -f kubernetes/${DEPLOYMENT_NAMESPACE}/config-app.yml \
            -f kubernetes/config-web.yml \
            -f kubernetes/deployment.yml
        """
      }
    }
  }
}
