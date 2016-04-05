#! /usr/bin/env python
import sys
import os
import matplotlib
matplotlib.use( 'Agg' )
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

data = load_files("/var/www/masterv1/storage/uploads/train/",categories=None)

data_test = load_files("/var/www/masterv1/storage/uploads/%s/test/" % (sys.argv[1]),categories=None)
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
#print('%%%%'*20,'train \n')
#print('train target length',len(data.target))
#print('train target_names',data.target_names)
#print('train matrix',vectorized_data.shape)


#### loaded test set stats
#print('%%%%'*20,'test \n')
### display matrix before normalization
#print('test target length',len(data_test.target))
#print('test target_names',data_test.target_names)
#print ("Clean test matrix", vectorized_test_clean.shape)
#print ("Transformed test matrix", vectorized_test.shape)

X_train = vectorizer.fit_transform(data.data, y=None)
#X_train = vectorized_data.data
y_train = data.target


svc = svm.SVC(kernel='linear', probability=True)
#svc = svm.SVC(kernel='rbf',probability=True)
#svc = svm.SVC(kernel='poly',degree=3,probability=True)
clf = svc.fit(X_train, y_train)

prediction = clf.predict(vectorized_test)
for i in range(len(prediction)):
    certainty = np.max(clf.predict_proba(vectorized_test[i])) #vectorized test
    predicted_label=data.target_names[prediction[[i]]]
    #print("% confidence", certainty, predicted_label, "predicted label", prediction[i], "original",data_test.target[i],filez[i])
    percentage_prob=("{0:.2f}%".format(certainty*100))
    #print(percentage_prob)


y_test = data_test.target

#print(classification_report(y_test, prediction, target_names=data_test.target_names))
cm = confusion_matrix(y_test, prediction)
#print("Confusion matrix:")
#print(cm)

def plot_confusion_matrix(cm, classes, title):
    pl.clf()
    pl.matshow(cm, fignum=False, cmap='Blues', vmin=0, vmax=0.6)
    ax = pl.axes()
    ax.set_xticks(range(len(classes)))
    ax.set_xticklabels(classes)
    ax.xaxis.set_ticks_position("bottom")
    ax.set_yticks(range(len(classes)))
    ax.set_yticklabels(classes)
    pl.title(title)
    pl.colorbar()
    pl.grid(False)
    pl.xlabel('Predicted class')
    pl.ylabel('Actual Class')
    pl.savefig('img.png')
    #pl.show()

classes = np.array(data.target_names)
plot_confusion_matrix(cm, classes, "Confusion Matrix")