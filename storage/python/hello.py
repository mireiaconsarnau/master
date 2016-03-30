#! /usr/bin/env python
from sklearn.metrics import confusion_matrix
from sklearn.metrics import classification_report
from sklearn.metrics import accuracy_score
from matplotlib import pyplot as pl
#from sklearn.linear_model import SGDClassifier
from sklearn import tree
from sklearn.feature_extraction.text import CountVectorizer, TfidfTransformer
from sklearn.pipeline import Pipeline
import numpy as np
from sklearn.datasets import load_files
from sklearn.feature_extraction import DictVectorizer
from sklearn import svm

data = load_files('/home/mireia/anaconda3/exp4/train/',categories=None)

data_test = load_files('/home/mireia/anaconda3/exp4/test/',categories=None)
test_data = [open(f).read() for f in data_test.filenames]

filez=[]
for each in data_test.filenames:
    filez.append(each)

vectorizer = Pipeline([('vect', CountVectorizer(ngram_range=(1, 3), min_df=1,decode_error='replace')),
                         ('tfidf', TfidfTransformer())
                          ])
vectorized_data=vectorizer.fit_transform(data.data, y=None)# [:, :2] only 2 features are considered
vectorized_test=vectorizer.transform(test_data)
vectorized_test_clean=vectorizer.fit_transform(test_data)# [:, :2]only 2 features are considere
#### loaded training set stats
print('%%%%'*20,'train');
print("mireia2");