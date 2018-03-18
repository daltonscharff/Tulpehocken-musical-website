from os import urandom
from base64 import b64encode

random_bytes = urandom(64)
token = b64encode(random_bytes).decode('utf-8')
print("SECRET_KEY=\"" + token[:-2] + "\"", file=open("app/secret_key.cfg", "w"))
