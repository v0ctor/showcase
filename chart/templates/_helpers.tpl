{{- define "image" }}
{{- printf "%s/%s:%s" .Values.registry.name .Values.images.server.name (default "latest" .Values.images.server.tag) }}
{{- end }}
