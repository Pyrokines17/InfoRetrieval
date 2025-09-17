from django.contrib import admin
from .models import University, Student

# Register your models here.

class UniversityAdmin(admin.ModelAdmin):
    list_display = ('full_name', 'short_name', 'creation_date')

admin.site.register(University, UniversityAdmin)

class StudentAdmin(admin.ModelAdmin):
    list_display = ('first_name', 'last_name', 'middle_name', 'birth_date', 'university', 'study_start')

admin.site.register(Student, StudentAdmin)
