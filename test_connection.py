import mysql.connector

try:
    # Configura tu conexión
    connection = mysql.connector.connect(
        host="localhost",       # Cambia si usas otro host
        user="root",      # Cambia por tu usuario de MySQL
        password="1234", # Contraseña de tu usuario
        database="boat_rentals" # Base de datos que creaste
    )

    if connection.is_connected():
        print("¡Conexión exitosa a MySQL!")
except mysql.connector.Error as e:
    print("Error al conectar a MySQL:", e)
finally:
    if 'connection' in locals() and connection.is_connected():
        connection.close()
        print("Conexión cerrada.")
