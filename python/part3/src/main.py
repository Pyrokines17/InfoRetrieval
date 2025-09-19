from flask_login import logout_user, login_required, LoginManager, login_user, current_user
from flask import Flask, render_template, request, redirect, url_for, flash
from forms import UniversityForm, StudentForm, LoginForm
from models import User
import psycopg

app = Flask(__name__) 
app.config['SECRET_KEY'] = 'your_secret_key'

login_manager = LoginManager()
login_manager.init_app(app)
login_manager.login_view = 'login'
login_manager.login_message = 'Please log in to access this page.'

@login_manager.user_loader
def load_user(user_id):
    return User.get_by_id(int(user_id))

def get_db_connection(): 
    conn = psycopg.connect(
        host="localhost",
        dbname="postgres",
        user="postgres",
        password="wasd5432")
    return conn

@app.route('/') 
def index(): 
    return render_template('index.html')

@app.route('/univer/create', methods=['GET', 'POST'])
@login_required
def create_univer():
    form = UniversityForm()

    if request.method == 'POST' and form.validate_on_submit():
        full_name = form.full_name.data
        short_name = form.short_name.data
        creation_date = form.creation_date.data

        conn = get_db_connection()
        cur = conn.cursor()
        cur.execute('INSERT INTO University (full_name, short_name, created) VALUES (%s, %s, %s)',
                    (full_name, short_name, creation_date))
        conn.commit()
        cur.close()
        conn.close()
        return redirect(url_for('read_univer'))
    
    return render_template('create_univer.html', form=form)

@app.route('/univer/read', methods=['GET'])
def read_univer():
    conn = get_db_connection()
    cur = conn.cursor()
    cur.execute('SELECT * FROM University')
    univers = cur.fetchall()
    cur.close()
    conn.close()
    return render_template('read_univer.html', univers=univers)

@app.route('/univer/modify/<int:univer_id>', methods=['GET', 'POST'])
@login_required
def modify_univer(univer_id):
    conn = get_db_connection()
    cur = conn.cursor()
    form = UniversityForm()

    if request.method == 'POST' and form.validate_on_submit():
        full_name = form.full_name.data
        short_name = form.short_name.data
        creation_date = form.creation_date.data

        cur.execute('UPDATE University SET full_name=%s, short_name=%s, created=%s WHERE id=%s',
                    (full_name, short_name, creation_date, univer_id))
        conn.commit()
        cur.close()
        conn.close()
        return redirect(url_for('read_univer'))
    else:
        cur.execute('SELECT * FROM University WHERE id=%s', (univer_id,))
        univer = cur.fetchone()

        if univer:
            form.full_name.data = univer[1]  
            form.short_name.data = univer[2]   
            form.creation_date.data = univer[3]

        cur.close()
        conn.close()
        return render_template('modify_univer.html', univer=univer, form=form)
    
@app.route('/univer/delete/<int:univer_id>', methods=['POST', 'GET'])
@login_required
def delete_univer(univer_id):
    conn = get_db_connection()
    cur = conn.cursor()
    cur.execute('DELETE FROM University WHERE id=%s', (univer_id,))
    conn.commit()
    cur.close()
    conn.close()
    return redirect(url_for('read_univer'))

@app.route('/student/create', methods=['GET', 'POST'])
@login_required
def create_student():
    form = StudentForm()
    conn = get_db_connection()
    cur = conn.cursor()
    cur.execute('SELECT id, full_name FROM University')
    universities = cur.fetchall()
    form.university_id.choices = [('', 'Select University')] + [(str(univ[0]), univ[1]) for univ in universities]
    
    if request.method == 'POST' and form.validate_on_submit():
        first_name = form.first_name.data
        last_name = form.last_name.data
        middle_name = form.middle_name.data
        birth_date = form.birth_date.data
        university_id = int(form.university_id.data)  
        receipt_date = form.receipt_date.data

        cur.execute('INSERT INTO Students (first_name, last_name, middle_name, birth_date, university_id, receipt_date) VALUES (%s, %s, %s, %s, %s, %s)',
                    (first_name, last_name, middle_name, birth_date, university_id, receipt_date))
        conn.commit()
        cur.close()
        conn.close()
        return redirect(url_for('read_student'))
    
    cur.close()
    conn.close()
    return render_template('create_student.html', form=form)
    
@app.route('/student/read', methods=['GET'])
def read_student():
    conn = get_db_connection()
    cur = conn.cursor()
    cur.execute('''
        SELECT Students.id, Students.first_name, Students.last_name, Students.middle_name, 
               Students.birth_date, University.full_name AS university, Students.receipt_date
        FROM Students
        JOIN University ON Students.university_id = University.id
    ''')
    students = cur.fetchall()
    cur.close()
    conn.close()
    return render_template('read_student.html', students=students)

@app.route('/student/modify/<int:student_id>', methods=['GET', 'POST'])
@login_required
def modify_student(student_id):
    conn = get_db_connection()
    cur = conn.cursor()
    cur.execute('SELECT id, full_name FROM University')
    universities = cur.fetchall()
    form = StudentForm()
    form.university_id.choices = [('', 'Select University')] + [(str(univ[0]), univ[1]) for univ in universities]

    if request.method == 'POST' and form.validate_on_submit():
        first_name = form.first_name.data
        last_name = form.last_name.data
        middle_name = form.middle_name.data
        birth_date = form.birth_date.data
        university_id = int(form.university_id.data)
        receipt_date = form.receipt_date.data
        
        cur.execute('''
            UPDATE Students 
            SET first_name=%s, last_name=%s, middle_name=%s, birth_date=%s, university_id=%s, receipt_date=%s 
            WHERE id=%s
        ''', (first_name, last_name, middle_name, birth_date, university_id, receipt_date, student_id))
        conn.commit()
        cur.close()
        conn.close()
        return redirect(url_for('read_student'))
    else:
        cur.execute('SELECT * FROM Students WHERE id=%s', (student_id,))
        student = cur.fetchone()

        if student:
            form.first_name.data = student[1]  
            form.last_name.data = student[2]   
            form.middle_name.data = student[3] 
            form.birth_date.data = student[4] 
            form.university_id.data = str(student[5]) 
            form.receipt_date.data = student[6] 
        
        cur.close()
        conn.close()
        return render_template('modify_student.html', student=student, form=form)
    
@app.route('/student/delete/<int:student_id>', methods=['POST', 'GET'])
@login_required
def delete_student(student_id):
    conn = get_db_connection()
    cur = conn.cursor()
    cur.execute('DELETE FROM Students WHERE id=%s', (student_id,))
    conn.commit()
    cur.close()
    conn.close()
    return redirect(url_for('read_student'))

@app.route('/logout')
@login_required
def logout():
    logout_user()
    return redirect(url_for('index'))

@app.route('/login', methods=['GET', 'POST'])
def login():
    if current_user.is_authenticated:
        return redirect(url_for('index'))
    
    form = LoginForm()
    if form.validate_on_submit():
        username = form.username.data
        password = form.password.data
        
        user = User.get_by_username(username)
        
        if user and user.check_password(password):
            login_user(user)
            flash('You have successfully logged in!', 'success')

            next_page = request.args.get('next')
            return redirect(next_page) if next_page else redirect(url_for('index'))
        else:
            flash('Invalid username or password.', 'error')
    
    return render_template('login.html', form=form)

if __name__ == "__main__": 
    app.run()
