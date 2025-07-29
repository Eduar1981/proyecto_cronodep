from flask import Blueprint, request, jsonify, abort
from .. import db
from ..models.user import User

user_bp = Blueprint('users', __name__)

ALLOWED_ROLES = [
    'superadmin',
    'admin',
    'deportista',
    'instructor',
    'padre_acudiente',
    'tesorero'
]

# CREATE
@user_bp.route('/', methods=['POST'])
def create_user():
    data = request.json
    if not data or not all(k in data for k in ('name', 'email', 'password', 'role')):
        abort(400, description='Missing required fields')
    if data['role'] not in ALLOWED_ROLES:
        abort(400, description='Invalid role')
    user = User(name=data['name'], email=data['email'], password=data['password'], role=data['role'])
    db.session.add(user)
    db.session.commit()
    return jsonify(user.to_dict()), 201

# READ ALL
@user_bp.route('/', methods=['GET'])
def get_users():
    users = User.query.all()
    return jsonify([u.to_dict() for u in users])

# READ ONE
@user_bp.route('/<int:user_id>', methods=['GET'])
def get_user(user_id):
    user = User.query.get_or_404(user_id)
    return jsonify(user.to_dict())

# UPDATE
@user_bp.route('/<int:user_id>', methods=['PUT'])
def update_user(user_id):
    user = User.query.get_or_404(user_id)
    data = request.json
    if 'role' in data and data['role'] not in ALLOWED_ROLES:
        abort(400, description='Invalid role')
    for field in ('name', 'email', 'password', 'role'):
        if field in data:
            setattr(user, field, data[field])
    db.session.commit()
    return jsonify(user.to_dict())

# DELETE
@user_bp.route('/<int:user_id>', methods=['DELETE'])
def delete_user(user_id):
    user = User.query.get_or_404(user_id)
    db.session.delete(user)
    db.session.commit()
    return '', 204
