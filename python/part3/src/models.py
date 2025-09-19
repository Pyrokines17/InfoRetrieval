from werkzeug.security import check_password_hash
from flask_login import UserMixin
import psycopg

class User(UserMixin):
    def __init__(self, id, username, password_hash, email=None):
        self.id = id
        self.username = username
        self.password_hash = password_hash
        self.email = email

    def check_password(self, password):
        return check_password_hash(self.password_hash, password)

    @staticmethod
    def get_db_connection():
        conn = psycopg.connect(
            host="localhost",
            dbname="postgres",
            user="postgres",
            password="wasd5432"
        )
        return conn

    @staticmethod
    def get_by_id(user_id):
        conn = User.get_db_connection()
        cur = conn.cursor()
        try:
            cur.execute('SELECT id, username, password_hash, email FROM Users WHERE id = %s', (user_id,))
            user_data = cur.fetchone()
            if user_data:
                return User(
                    id=user_data[0],
                    username=user_data[1],
                    password_hash=user_data[2],
                    email=user_data[3]
                )
            return None
        finally:
            cur.close()
            conn.close()

    @staticmethod
    def get_by_username(username):
        conn = User.get_db_connection()
        cur = conn.cursor()
        try:
            cur.execute('SELECT id, username, password_hash, email FROM Users WHERE username = %s', (username,))
            user_data = cur.fetchone()
            if user_data:
                return User(
                    id=user_data[0],
                    username=user_data[1],
                    password_hash=user_data[2],
                    email=user_data[3]
                )
            return None
        finally:
            cur.close()
            conn.close()

    def get_id(self):
        return str(self.id)
    