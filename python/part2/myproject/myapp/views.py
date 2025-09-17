from django.shortcuts import render, redirect
from django.template.response import TemplateResponse
from .models import University, Student
from . import forms

# Create your views here.

def index(request):
    return TemplateResponse(request, "index.html")

def create_univer(request):
    if request.method == "POST":
        form = forms.UniversityForm(request.POST)
        if form.is_valid():
            cd = form.cleaned_data
            univer = University(
                full_name=cd["full_name"],
                short_name=cd["short_name"],
                creation_date=cd["creation_date"]
            )
            univer.save()
            return redirect("read_univer")
        else:
            data = {"form": form}
            return TemplateResponse(request, "create_univer.html", data)
    else:
        form = forms.UniversityForm()
        data = {"form": form}
        return TemplateResponse(request, "create_univer.html", data)

def read_univer(request):
    univers = University.objects.all()
    data = {"univers": univers}
    return TemplateResponse(request, "read_univer.html", data)

def modify_univer(request, univer_id):
    try:
        univer = University.objects.get(id=univer_id)
    except University.DoesNotExist:
        return redirect("read_univer")

    if request.method == "POST":
        form = forms.UniversityForm(request.POST)
        if form.is_valid():
            cd = form.cleaned_data
            univer.full_name = cd["full_name"]
            univer.short_name = cd["short_name"]
            univer.creation_date = cd["creation_date"]
            univer.save()
            return redirect("read_univer")
        else:
            data = {"form": form, "univer": univer}
            return TemplateResponse(request, "modify_univer.html", data)
    else:
        initial_data = {
            "full_name": univer.full_name,
            "short_name": univer.short_name,
            "creation_date": univer.creation_date
        }
        form = forms.UniversityForm(initial=initial_data)
        data = {"form": form, "univer": univer}
        return TemplateResponse(request, "modify_univer.html", data)

def delete_univer(request, univer_id):
    try:
        univer = University.objects.get(id=univer_id)
        univer.delete()
    except University.DoesNotExist:
        pass
    return redirect("read_univer")

def create_student(request):
    if request.method == "POST":
        form = forms.StudentForm(request.POST)
        if form.is_valid():
            cd = form.cleaned_data
            student = Student(
                first_name=cd["first_name"],
                last_name=cd["last_name"],
                middle_name=cd["middle_name"],
                birth_date=cd["birth_date"],
                university=cd["university"],
                study_start=cd["study_start"]
            )
            student.save()
            return redirect("read_student")
        else:
            data = {"form": form}
            return TemplateResponse(request, "create_student.html", data)
    else:
        form = forms.StudentForm()
        data = {"form": form}
        return TemplateResponse(request, "create_student.html", data)
    
def read_student(request):
    students = Student.objects.all()
    data = {"students": students}
    return TemplateResponse(request, "read_student.html", data)

def modify_student(request, student_id):
    try:
        student = Student.objects.get(id=student_id)
    except Student.DoesNotExist:
        return redirect("read_student")

    if request.method == "POST":
        form = forms.StudentForm(request.POST)
        if form.is_valid():
            cd = form.cleaned_data
            student.first_name = cd["first_name"]
            student.last_name = cd["last_name"]
            student.middle_name = cd["middle_name"]
            student.birth_date = cd["birth_date"]
            student.university = cd["university"]
            student.study_start = cd["study_start"]
            student.save()
            return redirect("read_student")
        else:
            data = {"form": form, "student": student}
            return TemplateResponse(request, "modify_student.html", data)
    else:
        initial_data = {
            "first_name": student.first_name,
            "last_name": student.last_name,
            "middle_name": student.middle_name,
            "birth_date": student.birth_date,
            "university": student.university,
            "study_start": student.study_start
        }
        form = forms.StudentForm(initial=initial_data)
        data = {"form": form, "student": student}
        return TemplateResponse(request, "modify_student.html", data)
    
def delete_student(request, student_id):
    try:
        student = Student.objects.get(id=student_id)
        student.delete()
    except Student.DoesNotExist:
        pass
    return redirect("read_student")
