from flask import Flask
from flask_sqlalchemy import SQLAlchemy

# Initialize Flask application
app = Flask(__name__)

# Configurations
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///cronodep.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

# Initialize database
db = SQLAlchemy(app)

from .models.user import User

# Create tables if they don't exist
with app.app_context():
    db.create_all()

# Register blueprints/controllers
from .controllers.user_controller import user_bp
app.register_blueprint(user_bp, url_prefix='/users')

