from flask import Flask
from flask_sqlalchemy import SQLAlchemy
from flask_migrate import Migrate

app = Flask(__name__)
app.config.from_pyfile("config.cfg")
app.config.from_pyfile("secret_key.cfg")
db = SQLAlchemy(app)
migrate = Migrate(app, db)

from app import routes, models
