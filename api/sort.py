from flask import Flask, request, jsonify
from flask_restful import Resource, Api
from flask_mysqldb import MySQLdb

app = Flask(__name__)
api = Api(app)

app.config['JSON_SORT_KEYS'] = False
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = ''
app.config['MYSQL_DATABASE_DB'] = 'meme_review'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
app.config['MYSQL_DATABASE_PORT'] = '3306'
conn = MySQLdb.connect('127.0.0.1', user='root', password='')


def main(n):
    def a(val):
        return val[n]

    cur = conn.cursor()
    cur.execute('use meme_review')
    cur.execute('select * from meme')
    memes = list(cur.fetchall())
    memes.sort(key=a, reverse=True)
    sorted_memes = {}
    i = 0
    for meme in memes:
        json_meme = {
            "meme_id": meme[0],
            "name": meme[1],
            "user_id": meme[2],
            "url": meme[3],
            "likes": meme[4],
            "dislikes": meme[5],
            "date_created": meme[6]

        }
        sorted_memes[i] = json_meme
        i = i + 1
    return jsonify(sorted_memes)


class SortByDate(Resource):

    def post(self):
        x = main(6)
        return x


class SortByLikes(Resource):

    def post(self):
        x = main(4)
        return x


class SortByDislikes(Resource):

    def post(self):
        x = main(5)
        return x


api.add_resource(SortByDate, '/sortbydate')
api.add_resource(SortByLikes, '/sortbylikes')
api.add_resource(SortByDislikes, '/sortbydislikes')
app.run(port=3000, debug=True)
