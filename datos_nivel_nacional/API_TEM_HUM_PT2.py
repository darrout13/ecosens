import requests
import mysql.connector
from datetime import datetime
import time

def extraer_datos_weatherbit(api_key):
    url = 'https://api.weatherbit.io/v2.0/current'

    params = {
        'key': api_key,
        'lang': 'es',
        'lat': '10.96854',
        'lon': '-74.78132'
    }

    response = requests.get(url, params=params)

    if response.status_code == 200:
        weather_data = response.json()['data'][0]
        temperatura2 = weather_data['temp']
        humedad2 = weather_data['rh']
        return temperatura2, humedad2
    else:
        print("Error al obtener los datos de Weatherbit:", response.status_code)
        return None, None

def almacenar_datos_en_mysql(temperatura2, humedad2):
    try:
        conexion = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='registros'
        )
        cursor = conexion.cursor()
        fecha_actual = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        query = "INSERT INTO mediciones_nacional (fecha, temperatura2, humedad2) VALUES (%s, %s, %s)"
        datos = (fecha_actual, temperatura2, humedad2)
        cursor.execute(query, datos)
        conexion.commit()
        print("Datos almacenados en la base de datos correctamente.")
    except mysql.connector.Error as error:
        print("Error al conectarse a la base de datos:", error)
    finally:
        if conexion.is_connected():
            cursor.close()
            conexion.close()
            print("Conexión a la base de datos cerrada.")

api_key = '85c973b55c0c45a3ae67e774568c73d6'
while True:
    temperatura2, humedad2 = extraer_datos_weatherbit(api_key)
    if temperatura2 is not None and humedad2 is not None:
        print("Temperatura actual:", temperatura2)
        print("Humedad actual:", humedad2)
        almacenar_datos_en_mysql(temperatura2, humedad2)
    else:
        print("No se pudieron obtener los datos de Weatherbit.")
    time.sleep(60)
    
if __name__ == "__main__":
    port = int(os.getenv("PORT", default=5000))
    app.run(debug=True, host='0.0.0.0', port=port)
