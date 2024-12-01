import mysql.connector

def get_connection():
    connection = mysql.connector.connect(
        host="localhost",       # Cambia esto si tu servidor no está en localhost
        user="root",      # Usuario de MySQL
        password="1234", # Contraseña de MySQL
        database="boat_rentals" # Nombre de la base de datos
    )
    return connection
