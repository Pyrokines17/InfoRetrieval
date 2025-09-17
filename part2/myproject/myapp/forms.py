from django import forms
import datetime
from .models import University

class UniversityForm(forms.Form):
    full_name = forms.CharField(label='Full Name', max_length=1023)
    short_name = forms.CharField(label='Short Name', max_length=511)
    creation_date = forms.DateField(
        label='Creation Date',
        widget=forms.SelectDateWidget(years=range(1900, datetime.date.today().year + 1))
    )

class StudentForm(forms.Form):
    first_name = forms.CharField(label='First Name', max_length=255)
    last_name = forms.CharField(label='Last Name', max_length=255)
    middle_name = forms.CharField(label='Middle Name', max_length=255, required=False)
    birth_date = forms.DateField(
        label='Birth Date',
        widget=forms.SelectDateWidget(years=range(1900, datetime.date.today().year + 1))
    )
    university = forms.ModelChoiceField(
        label='University',
        queryset=University.objects.all(),
        empty_label="Select University"
    )
    study_start = forms.DateField(
        label='Study Start Date',
        widget=forms.SelectDateWidget(years=range(1900, datetime.date.today().year + 1))
    )
