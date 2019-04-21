{{- define "image" }}
{{- printf "%s/%s:%s" .Values.registry.name .Values.images.app.name (default "latest" .Values.images.app.tag) }}
{{- end }}
