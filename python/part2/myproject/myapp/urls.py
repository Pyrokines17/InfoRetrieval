from django.urls import path
from myapp import views

urlpatterns = [
    path('', views.index, name="home"),
    path('univer/create/', views.create_univer, name="create_univer"),
    path('univer/read/', views.read_univer, name="read_univer"),
    path('univer/modify/<int:univer_id>/', views.modify_univer, name="modify_univer"),
    path('univer/delete/<int:univer_id>/', views.delete_univer, name="delete_univer"),
    path('student/create/', views.create_student, name="create_student"),
    path('student/read/', views.read_student, name="read_student"),
    path('student/modify/<int:student_id>/', views.modify_student, name="modify_student"),
    path('student/delete/<int:student_id>/', views.delete_student, name="delete_student"),
]
