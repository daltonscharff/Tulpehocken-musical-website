# Tulpehocken Musical

## Installation Instructions (in Ubuntu)

1. Clone this repository and navigate to it in the terminal
1. Run **pip install virutalenv** to install virutalenv on your system
1. Run **which python3** and note the response
    * This is the location of the python3 interpreter on your system
1. Run **python -m virutalenv venv -p *python_location***, replacing ***python_location*** with the location of your python interpreter found in the previous step
1. Run **source venv/bin/activate** to start your virtual environment
1. Run **pip install -r requirements.txt** to install the python dependencies for this project
1. Run **export FLASK_APP=musical.py** to set the FLASK_APP variable
1. Run **flask initdb** to create the sqlite3 database
1. Run **flask run** to run the project
1. Open *localhost:5000* in your browser to use the app

    Alternatively, you can run this after completing step 1. Remember to replace \*python_location\* with the location of the python3 interpreter on your system:
        pip install virutalenv
        python-mvirutalenv venv -p *python_location*
        source venv/bin/activate
        pip install -r requirements.txt
        export FLASK_APP=musical.py
        flask initdb
        flask run
