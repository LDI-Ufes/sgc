#!/bin/bash

kubectl delete -f 8-ingress.yaml
sleep 2

kubectl delete -f 7-service.yaml
sleep 2

kubectl delete -f 6-deployment.yaml
sleep 2

kubectl delete -f 5-persistentVolumes.yaml
sleep 2

kubectl delete -f 4-dbService.yaml
sleep 2

kubectl delete -f 3-statefulset.yaml
sleep 2

kubectl delete -f 2-configMap.yaml
sleep 2

kubectl delete -f 1-secret.yaml
