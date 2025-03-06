#!/bin/bash

# Verificar si PHP está instalado
if ! command -v php &> /dev/null
then
    echo "PHP no está instalado. Instalándolo..."
    
    # Detectar el sistema operativo e instalar PHP
    if [[ -f /etc/debian_version ]]; then
        sudo apt update && sudo apt install -y php
    elif [[ -f /etc/redhat-release ]]; then
        sudo yum install -y php
    elif [[ -f /etc/arch-release ]]; then
        sudo pacman -Sy --noconfirm php
    else
        echo "Sistema no reconocido. Instala PHP manualmente."
        exit 1
    fi
else
    echo "PHP ya está instalado."
fi

# Iniciar el servidor en la carpeta actual
echo "Iniciando servidor PHP en http://127.0.0.1:8000"
php -S 127.0.0.1:8000 &

# Esperar unos segundos para que el servidor inicie
sleep 2

# Abrir en el navegador predeterminado
if command -v xdg-open &> /dev/null; then
    xdg-open http://127.0.0.1:8000
elif command -v gnome-open &> /dev/null; then
    gnome-open http://127.0.0.1:8000
elif command -v open &> /dev/null; then
    open http://127.0.0.1:8000  # Para macOS
else
    echo "No se pudo abrir el navegador automáticamente. Abre manualmente http://127.0.0.1:8000"
fi
