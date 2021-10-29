FROM python:3

WORKDIR /usr/src/app

RUN pip install --no-cache-dir -r requirements.txt
RUN pip install mysql-connector-python
COPY . .

CMD [ "python", "./your-daemon-or-script.py" ]