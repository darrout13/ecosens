from flask import Flask, request, jsonify
from flask_cors import CORS
from datetime import datetime
from flask_mysqldb import MySQL
import os

app = Flask(__name__)
CORS(app)

app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''  # Cambia por tu contraseña MySQL
app.config['MYSQL_DB'] = 'registros'
mysql = MySQL(app)

@app.route('/sendDato', methods=['POST'])
def sendDato():
    try:
        if request.method == 'POST':
            data = request.get_json()
            # Verificar que se reciban todos los datos necesarios
            required_keys = ['valor_aire', 'valor_convertido_aire', 'temperatura', 'humedad',
                             'CO', 'Alcohol', 'CO2', 'Toluen', 'NH4', 'Aceton']
            if all(key in data for key in required_keys):
                valor_aire = data['valor_aire']
                valor_convertido_aire = data['valor_convertido_aire']
                temperatura = data['temperatura']
                humedad = data['humedad']
                CO = data['CO']
                Alcohol = data['Alcohol']
                CO2 = data['CO2']
                Toluen = data['Toluen']
                NH4 = data['NH4']
                Aceton = data['Aceton']
                
                m_fecha_calidad_aire = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                fecha_actual = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                id_usuario = 29  # Cambia por el ID de usuario correspondiente

                cur = mysql.connection.cursor()
                
                # Insertar datos en la tabla medicion_calidad_aire
                cur.execute("INSERT INTO medicion_calidad_aire (m_fecha_calidad_aire, valor_aire, valor_convertido_aire, id_usuario) VALUES (%s, %s, %s, %s)", 
                            (m_fecha_calidad_aire, valor_aire, valor_convertido_aire, id_usuario))
                mysql.connection.commit()

                # Insertar datos en la tabla mediciones_temperatura_humedad
                cur.execute("INSERT INTO mediciones_temperatura_humedad (fecha, temperatura, humedad) VALUES (%s, %s, %s)", 
                            (fecha_actual, temperatura, humedad))
                mysql.connection.commit()
                
                # Insertar datos en la tabla mediciones_gases
                cur.execute("INSERT INTO mediciones_gases (CO, Alcohol, CO2, Toluen, NH4, Aceton, fecha) VALUES (%s, %s, %s, %s, %s, %s, %s)", 
                            (CO, Alcohol, CO2, Toluen, NH4, Aceton, m_fecha_calidad_aire))
                mysql.connection.commit()
                
                cur.close()

                return jsonify({"informacion": "Registro exitoso y datos almacenados"}), 201
            else:
                return jsonify({"informacion": "Datos incompletos"}), 400
    except Exception as e:
        print(e)
        return jsonify({"informacion": "Error en el servidor"}), 500


if __name__ == "__main__":
    port = int(os.getenv("PORT", default=5000))
    app.run(debug=True, host='0.0.0.0', port=port)
