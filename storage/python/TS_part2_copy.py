#! /usr/bin/env python
import sys
import os
import numpy as np
import matplotlib
matplotlib.use( 'Agg' )
import matplotlib.path as path
import matplotlib.pyplot as plt
import matplotlib.patches as patches
from textstat import textstat

import codecs

test_data =  codecs.open('/var/www/html/masterv1/storage/uploads/%s/test/%s/%s' % (sys.argv[1],sys.argv[2],sys.argv[3])).read().lower()

A= (textstat.flesch_reading_ease(test_data)/10)
B= (textstat.smog_index(test_data))
C= (textstat.flesch_kincaid_grade(test_data))
D= (textstat.coleman_liau_index(test_data))
E= (textstat.automated_readability_index(test_data))
F= (textstat.dale_chall_readability_score(test_data))
G= ((textstat.difficult_words(test_data))/100)
H= (textstat.linsear_write_formula(test_data))
I= (textstat.gunning_fog(test_data))
J= (textstat.text_standard(test_data)[0])
K=(textstat.text_standard(test_data))
#print("flesch_reading_ease: %r \n Smog Index: %r \n flesch_kincaid_grade: %r \n coleman_liau_index %r \n automated_readability_index %r \n dale_chall %r \n difficult_words %r \n linsear_write_formula %r \n gunning_fog %r \n text_standard %r" %(A,B,C,D,E,F,G,H,I,K))

# Data to be represented
# ----------
properties = ["flesch", "smog", "flesch_kincaid", "coleman", "automated", "dale chall", "difficult_words","linsear_write","gunning_fog"]

#values = np.random.uniform(5,9,len(properties))
values=[A,B,C,D,E,F,G,H,I]
# ----------

# Choose some nice colors
matplotlib.rc('axes', facecolor = 'white')

# Make figure background the same colors as axes 
fig = plt.figure(figsize=(10,8), facecolor='white')

# Use a polar axes
axes = plt.subplot(111, polar=True)

# Set ticks to the number of properties (in radians)
t = np.arange(0,2*np.pi,2*np.pi/len(properties))
plt.xticks(t, [])

# Set yticks from 0 to 10
plt.yticks(np.linspace(0,10,11))

# Draw polygon representing values user train
points = [(x,y) for x,y in zip(t,values)]
points.append(points[0])
points = np.array(points)
codes = [path.Path.MOVETO,] + \
        [path.Path.LINETO,]*(len(values) -1) + \
        [ path.Path.CLOSEPOLY ]
_path = path.Path(points, codes)
_patch = patches.PathPatch(_path, fill=True, color='blue', linewidth=0, alpha=.1, label="User %r test" % sys.argv[1])
axes.add_patch(_patch)
_patch = patches.PathPatch(_path, fill=False, linewidth = 2)
axes.add_patch(_patch)

# Draw circles at value points
plt.scatter(points[:,0],points[:,1], linewidth=2,
            s=50, color='white', edgecolor='black', zorder=10)

# Set axes limits
plt.ylim(0,10)

# Draw ytick labels to make sure they fit properly
for i in range(len(properties)):
    angle_rad = i/float(len(properties))*2*np.pi
    angle_deg = i/float(len(properties))*360
    ha = "right"
    if angle_rad < np.pi/2 or angle_rad > 3*np.pi/2: ha = "left"
    plt.text(angle_rad, 10.75, properties[i], size=14,
             horizontalalignment=ha, verticalalignment="center")

    # A variant on label orientation
    #    plt.text(angle_rad, 11, properties[i], size=14,
    #             rotation=angle_deg-90,
    #             horizontalalignment='center', verticalalignment="center")


#plt.legend(["User train", "User Task Test"])

plt.legend()
plt.savefig('img_text.png')
#plt.show()