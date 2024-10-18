def list():
    return []

def store(data):

    return True

def update(id):
    return id

def delete(id):
    return id

def getRequestData(data):
    messages = ''

    name = data.get('name')
    username = data.get('username')
    email = data.get('email')
    password = data.get('password')
    confirmPassword = data.get('confirm_password')

    if not name or len(name) < 3:
        messages += 'The "Name" field are required and need at least 3 characters\n'

    if not username or len(username) < 3:
        messages += 'The "Username" field are required and need at least 3 characters\n'

    if not email or len(email) < 3:
        messages += 'The "Email" field are required and need at least 3 characters\n'

    if not password or len(password) < 6:
        messages += 'The "Password" field are required and need at least 6 characters\n'

    if password != confirmPassword:
        messages += 'The "Password" and "Confirm Password" fields must match each other\n'

    if len(messages) > 0:
        return {
            'error': True,
            'message': messages
        }
    
    return {
        'error': False,
        'message': None
    }