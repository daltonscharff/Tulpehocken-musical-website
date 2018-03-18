from flask import Flask, render_template, session, redirect, request, abort, url_for
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config.from_pyfile("config.cfg")
app.config.from_pyfile("secret_key.py")
db = SQLAlchemy(app)
