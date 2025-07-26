# 🏛️ Microservicio SAT - Sistema de Verificación Tributaria

API REST para verificar el estado tributario de contribuyentes guatemaltecos mediante consulta al sistema de la Superintendencia de Administración Tributaria (SAT).

## 📋 Tabla de Contenidos
- [Descripción](#descripción)
- [Tecnologías](#tecnologías)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Endpoints](#endpoints)
- [Ejemplos de Uso](#ejemplos-de-uso)
- [Base de Datos](#base-de-datos)
- [Testing](#testing)

## 📖 Descripción

Este microservicio permite verificar si un contribuyente tiene omisiones o multas tributarias pendientes en el sistema SAT. Se utiliza como parte de la arquitectura de microservicios para el control de acceso al sistema principal.

## 🛠️ Tecnologías

- **Python 3.8+**
- **Flask 2.3.3**
- **Flask-CORS 4.0.0**
- **MySQL Connector Python 8.2.0**
- **MySQL 8.0+**

## 🚀 Instalación

### 1. Clonar el repositorio
```bash
git clone <tu-repositorio>
cd microservicio-sat
```

### 2. Crear entorno virtual
```bash
python -m venv venv
source venv/bin/activate  # Linux/Mac
# venv\Scripts\activate   # Windows
```

### 3. Instalar dependencias
```bash
pip install flask flask-cors mysql-connector-python
```

### 4. Configurar base de datos
```sql
CREATE DATABASE microservicio_sat;
USE microservicio_sat;

CREATE TABLE IF NOT EXISTS contribuyentes_sat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nit VARCHAR(25) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL UNIQUE,
    nombre_completo VARCHAR(150),
    estado_tributario ENUM('al_dia', 'con_omisiones', 'suspendido') DEFAULT 'al_dia',
    fecha_ultimo_pago DATE,
    monto_adeudado DECIMAL(10,2) DEFAULT 0.00,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## ⚙️ Configuración

Editar las credenciales de base de datos en `ms_sat.py`:

```python
db_config = {
    'host': 'localhost',
    'port': 3306,
    'user': 'root',
    'password': 'tu_password',
    'database': 'microservicio_sat'
}
```

## 📡 Endpoints

### **GET /verificar_sat**

Verifica el estado tributario de un contribuyente por NIT o email.

#### Parámetros de consulta:
- `nit` (string, opcional): NIT del contribuyente (formato: 12345678-9)
- `email` (string, opcional): Email del contribuyente

> **Nota:** Debe enviarse al menos uno de los dos parámetros.

#### Respuestas:

**✅ Éxito (200 OK)**
```json
{
    "tiene_omisiones": false
}
```

**❌ Usuario no encontrado (404 Not Found)**
```json
{
    "error": "Usuario no encontrado"
}
```

**❌ Parámetros faltantes (400 Bad Request)**
```json
{
    "error": "Debe enviar nit o email"
}
```

**❌ Error de base de datos (500 Internal Server Error)**
```json
{
    "error": "Error en la base de datos: <detalle_del_error>"
}
```

## 🧪 Ejemplos de Uso

### **Consulta por NIT**

**Request:**
```http
GET http://localhost:5003/verificar_sat?nit=12345678-9
```

**Response:**
```json
{
    "tiene_omisiones": true
}
```

### **Consulta por Email**

**Request:**
```http
GET http://localhost:5003/verificar_sat?email=juan@example.com
```

**Response:**
```json
{
    "tiene_omisiones": false
}
```

### **Error - Parámetros faltantes**

**Request:**
```http
GET http://localhost:5003/verificar_sat
```

**Response:**
```json
{
    "error": "Debe enviar nit o email"
}
```

## 💾 Base de Datos

### Estructura de la tabla `contribuyentes_sat`:

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INT AUTO_INCREMENT | Identificador único |
| `nit` | VARCHAR(25) UNIQUE | NIT del contribuyente |
| `email` | VARCHAR(120) UNIQUE | Email del contribuyente |
| `nombre_completo` | VARCHAR(150) | Nombre completo |
| `estado_tributario` | ENUM | 'al_dia', 'con_omisiones', 'suspendido' |
| `fecha_ultimo_pago` | DATE | Fecha del último pago |
| `monto_adeudado` | DECIMAL(10,2) | Monto adeudado |
| `fecha_registro` | TIMESTAMP | Fecha de registro |

### Datos de prueba:

```sql
INSERT INTO contribuyentes_sat (nit, email, nombre_completo, estado_tributario, monto_adeudado) VALUES 
('12345678-9', 'juan@example.com', 'Juan Carlos Pérez López', 'con_omisiones', 1250.75),
('98765432-1', 'maria@example.com', 'María Elena González Ruiz', 'al_dia', 0.00),
('11111111-1', 'carlos@example.com', 'Carlos Roberto López Martínez', 'al_dia', 0.00);
```

## 🧪 Testing

### Usando cURL:

```bash
# Consulta por NIT
curl "http://localhost:5003/verificar_sat?nit=12345678-9"

# Consulta por email
curl "http://localhost:5003/verificar_sat?email=maria@example.com"

# Error de parámetros
curl "http://localhost:5003/verificar_sat"
```

### Usando Postman:

1. **Crear nueva request**
2. **Método:** GET
3. **URL:** `http://localhost:5003/verificar_sat`
4. **Params:** Agregar `nit` o `email`
5. **Send**

### Ejecutar el microservicio:

```bash
python ms_sat.py
```

**Output esperado:**
```
 * Serving Flask app 'ms_sat'
 * Debug mode: on
 * Running on http://127.0.0.1:5003
```

## 🔧 Configuración de CORS

El microservicio tiene CORS habilitado para permitir requests desde el frontend de Laravel:

```python
from flask_cors import CORS
app = Flask(__name__)
CORS(app)  # Permite requests desde cualquier origen
```

## 📞 Soporte

Para reportar problemas o solicitar nuevas funcionalidades, contactar al equipo de desarrollo.

---

**Desarrollado para el Sistema de Verificación Tributaria con Microservicios**  
*Universidad del Valle de Guatemala - Desarrollo Web 2*