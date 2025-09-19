from wtforms import StringField, DateField, SubmitField, PasswordField, SelectField
from wtforms.validators import DataRequired, ValidationError, Length
from flask_wtf import FlaskForm

def validate_university_selection(form, field):
    if not field.data or field.data == '':
        raise ValidationError('Please select a university.')

class UniversityForm(FlaskForm):
    full_name = StringField('Full Name', validators=[DataRequired()])
    short_name = StringField('Short Name', validators=[DataRequired()])
    creation_date = DateField('Creation Date', format='%Y-%m-%d', validators=[DataRequired()])
    submit = SubmitField('Submit')

class StudentForm(FlaskForm):
    first_name = StringField('First Name', validators=[DataRequired()])
    last_name = StringField('Last Name', validators=[DataRequired()])
    middle_name = StringField('Middle Name')
    birth_date = DateField('Birth Date', format='%Y-%m-%d', validators=[DataRequired()])
    university_id = SelectField('University', validators=[validate_university_selection])
    receipt_date = DateField('Receipt Date', format='%Y-%m-%d', validators=[DataRequired()])
    submit = SubmitField('Submit')

class LoginForm(FlaskForm):
    username = StringField('Username', validators=[DataRequired(), Length(min=3, max=50)])
    password = PasswordField('Password', validators=[DataRequired(), Length(min=3)])
    submit = SubmitField('Login')
