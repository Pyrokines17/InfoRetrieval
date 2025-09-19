from werkzeug.security import generate_password_hash
import psycopg

conn = psycopg.connect(
        host="localhost",
        dbname="postgres",
        user="postgres",
        password="wasd5432")

cur = conn.cursor()

cur.execute('DROP TABLE IF EXISTS University CASCADE;')
cur.execute('CREATE TABLE University (id serial PRIMARY KEY,'
                                 'full_name varchar (1023) NOT NULL,'
                                 'short_name varchar (511) NOT NULL,'
                                 'created date NOT NULL);'
                                 )

cur.execute('DROP TABLE IF EXISTS Students;')
cur.execute('CREATE TABLE Students (id serial PRIMARY KEY,'
                                 'first_name varchar (255) NOT NULL,'
                                 'last_name varchar (255) NOT NULL,'
                                 'middle_name varchar (255),'
                                 'birth_date date NOT NULL,'
                                 'university_id integer NOT NULL REFERENCES University(id) ON DELETE CASCADE,'
                                 'receipt_date date NOT NULL);'
                                 )

cur.execute('DROP TABLE IF EXISTS Users;')
cur.execute('CREATE TABLE Users (id serial PRIMARY KEY,'
                                 'username varchar (255) NOT NULL UNIQUE,'
                                 'password_hash varchar (255) NOT NULL,'
                                 'email varchar (255),'
                                 'created_at timestamp DEFAULT CURRENT_TIMESTAMP);'
                                 )

test_password_hash = generate_password_hash('admin123')
cur.execute('INSERT INTO Users (username, password_hash, email) VALUES (%s, %s, %s)',
            ('admin', test_password_hash, 'admin@example.com'))

conn.commit()

cur.close()
conn.close()
