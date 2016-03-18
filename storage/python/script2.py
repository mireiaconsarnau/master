import pylab as pl
import numpy as np
import os

from sklearn.datasets import load_files
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.naive_bayes import MultinomialNB
from sklearn.pipeline import Pipeline
from sklearn.feature_extraction.text import TfidfTransformer
from sklearn.metrics import confusion_matrix
from sklearn.linear_model import SGDClassifier
from sklearn.metrics import classification_report
from matplotlib import pyplot as pl
from sklearn.metrics import accuracy_score


from lightning import Lightning
from numpy import random, asarray

# load train
text_train_subset = load_files('C:/ML/exp3/train/',categories=None)
# load test
text_test_subset = load_files('C:/ML/exp3/test/',categories=None)


# Turn the text documents into vectors of word frequencies
vectorizer = Pipeline([('vect', CountVectorizer(decode_error='replace')),
                     ('tfidf', TfidfTransformer())])

print("CATEGORIES TRAIN",text_train_subset.target_names)
print("CATEGORIES TEST",text_test_subset.target_names)

X_train = vectorizer.fit_transform(text_train_subset.data)
y_train = text_train_subset.target

X_test = vectorizer.transform(text_test_subset.data)
y_test = text_test_subset.target

classifier = MultinomialNB().fit(X_train, y_train)
print("Training score: {0:.1f}%".format(
    classifier.score(X_train, y_train) * 100))
# avaluar el classificador en el conjunt de les proves
print("Testing score: {0:.1f}%".format(
    classifier.score(X_test, y_train) * 100))

##############get lengths
lentest=len(text_test_subset.data)
lentrain=len(text_train_subset.data)
print("number of train files:",lentrain,"number of test files", lentest)


pred = classifier.predict(X_test)
print(classification_report(y_test, pred, target_names=text_test_subset.target_names))
cm = confusion_matrix(y_test, pred)
print("Confusion matrix:")
print(cm)

pred_prob = classifier.predict_proba(X_test) 
print()
print(pred)
print(pred_prob)

#print(text_test_subset.target)
for i in range(pred_prob.shape[0]):
    #ind=(np.argmax(pred_prob==max(pred_prob[i])))%4
    print("Predicted class=",text_test_subset.target_names[i]," with probability ",max(pred_prob[i]))
    print("Probabilities of this file for all classes ", pred_prob[i])
    print()

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
    pl.show()

classes = np.array(text_test_subset.target_names)
plot_confusion_matrix(cm, classes, "Confusion Matrix")


conn=[]
for i in range(len(y_train)):
    for j in range(len(y_test)):
        if (cm[i][j]==1):
            #print("i=",i," j=",j," valor=",cm[i][j]) 
            #print("connexio=",i,j+len(y_train))
            conn.append([i,j+len(y_train)])
#print(conn)
lgn = Lightning(ipython=True, host='http://public.lightning-viz.org')
lgn.circle(conn, labels=text_train_subset.target_names+text_test_subset.target_names)