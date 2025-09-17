from django.db import models

# Create your models here.

class University(models.Model):
    full_name = models.CharField(max_length=1023, verbose_name="Full Name")
    short_name = models.CharField(max_length=511, verbose_name="Short Name")
    creation_date = models.DateField(verbose_name="Creation Date")

    def __str__(self):
        return self.full_name + " (" + self.short_name + ")"

class Student(models.Model):
    first_name = models.CharField(max_length=255, verbose_name="First Name")
    last_name = models.CharField(max_length=255, verbose_name="Last Name")
    middle_name = models.CharField(max_length=255, blank=True, null=True, verbose_name="Middle Name")
    birth_date = models.DateField(verbose_name="Birth Date")
    university = models.ForeignKey(University, on_delete=models.CASCADE, verbose_name="University")
    study_start = models.DateField(verbose_name="Study Start Date")

    def __str__(self):
        return f"{self.first_name} {self.last_name} ({self.university.short_name})"
